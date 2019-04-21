<?php

use App\Models\Chat;
use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Workspace;
use App\Models\WorkspaceApiKey;
use Illuminate\Support\Collection;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        [$workspacesAmount, $workspaceApiKeysRange, $workspaceUsersRange, $visitorsRange, $messagesRange] = $this->quiz();

        $bar = $this->command->getOutput()->createProgressBar($workspacesAmount);

        $bar->start();

        $workspaces = $this->createWorkspaces($workspacesAmount);
        foreach ($workspaces as $workspace) {
            $this->createWorkspaceApiKeys($workspace, $workspaceApiKeysRange);
            $users = $this->createWorkspaceUsers($workspace, $workspaceUsersRange);
            $visitors = $this->createWorkspaceVisitors($workspace, $visitorsRange);

            foreach ($visitors as $visitor) {
                $this->createMessages($this->createChat($visitor), $users->isEmpty() ? null : $users->random(), $messagesRange);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->command->getOutput()->newLine(2);
    }

    /**
     * @return array
     */
    protected function quiz(): array
    {
        // How many workspaces you need, defaulting to 10
        $workspacesAmount = (int)$this->command->ask('How many workspaces do you need?', 10);

        // Ask range for api keys per workspace needed
        $workspaceApiKeysRange = $this->command->ask('How many api keys per workspace do you need ?', sprintf('%d-%d', 0, 10));

        // Ask range for users per workspace needed
        $workspaceUsersRange = $this->command->ask('How many users per workspace do you need ?', sprintf('%d-%d', 0, 10));

        // Ask range for visitors per workspace needed
        $visitorsRange = $this->command->ask('How many visitors per workspace do you need ?', sprintf('%d-%d', 0, 20));

        // Ask range for messages per chat needed
        $messagesRange = $this->command->ask('How many messages per chat do you need ?', sprintf('%d-%d', 0, 20));

        return [$workspacesAmount, $workspaceApiKeysRange, $workspaceUsersRange, $visitorsRange, $messagesRange];
    }

    /**
     * Create Workspaces
     *
     * @param int $amount
     *
     * @return Collection
     */
    protected function createWorkspaces(int $amount): Collection
    {
        return factory(Workspace::class, $amount)->create();
    }

    /**
     * Create Users for each Workspace
     *
     * @param Workspace $workspace
     * @param int|string $range
     *
     * @return array|Collection
     */
    protected function createWorkspaceUsers(Workspace $workspace, $range)
    {
        $amount = $this->valueFromRange($range);

        $pivotAttributes = [['role_id' => Role::where(['name' => Role::ADMIN])->first()->getKey()]];
        if ($amount > 1) {
            $pivotAttributes = array_merge(
                $pivotAttributes,
                array_fill(1, $amount - 1, ['role_id' => Role::where(['name' => Role::USER])->first()->getKey()])
            );
        }

        return $workspace->users()
            ->saveMany(factory(User::class, $amount)->create(), $pivotAttributes);
    }

    /**
     * Create Visitors for each Workspace
     *
     * @param Workspace $workspace
     * @param int|string $range
     *
     * @return iterable
     */
    protected function createWorkspaceVisitors(Workspace $workspace, $range): iterable
    {
        $amount = $this->valueFromRange($range);

        return $workspace->visitors()
            ->saveMany(factory(Visitor::class, $amount)->make());
    }

    /**
     * Create Api Keys for each Workspace
     *
     * @param Workspace $workspace
     * @param int|string $range
     *
     * @return iterable
     */
    protected function createWorkspaceApiKeys(Workspace $workspace, $range): iterable
    {
        $amount = $this->valueFromRange($range);

        return $workspace->workspaceApiKeys()
            ->saveMany(factory(WorkspaceApiKey::class, $amount)->make());
    }

    /**
     * Create Chat for each Visitor
     *
     * @param Visitor $visitor
     *
     * @return Chat
     */
    protected function createChat(Visitor $visitor)
    {
        return $visitor->chats()
            ->save(factory(Chat::class)->make());
    }

    /**
     * Create Messages for each Workspace
     *
     * @param Chat $chat
     * @param User|null $user
     * @param int|string $range
     *
     * @return iterable
     */
    protected function createMessages(Chat $chat, ?User $user, $range): iterable
    {
        $visitor = $chat->visitor;
        $amount = $this->valueFromRange($range);

        return $chat->messages()
            ->saveMany(factory(Message::class, $amount)->make()->each(function (Message $message, $key) use ($visitor, $user) {
                $message->sender()->associate(($key % 3 !== 2 && $user) ? $user : $visitor);
            }));
    }

    /**
     * Return random value in given range
     *
     * @param string $range
     *
     * @return int
     */
    function valueFromRange(string $range): int
    {
        if (strpos($range, '-') === false) {
            return (int)$range;
        }

        return (int)rand(...explode('-', $range));
    }
}
