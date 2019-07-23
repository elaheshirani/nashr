<?php
/**
 * Created by PhpStorm.
 * User: Elahe sh
 * Date: 7/23/2019
 * Time: 11:23 PM
 */
echo "test";

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';
$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();

    $me = yield $MadelineProto->get_self();

    $MadelineProto->logger($me);

    if (!$me['bot']) {
        yield $MadelineProto->messages->sendMessage(['peer' => '@danogentili', 'message' => "Hi!\nThanks for creating MadelineProto! <3"]);
        yield $MadelineProto->channels->joinChannel(['channel' => '@goldonline1']);

        try {
            yield $MadelineProto->messages->importChatInvite(['hash' => 'https://t.me/joinchat/AAAAAE-WKBtKEp0amRTEYg']);
        } catch (\danog\MadelineProto\RPCErrorException $e) {
            $MadelineProto->logger($e);
        }

        yield $MadelineProto->messages->sendMessage(['peer' => 'https://t.me/joinchat/Bgrajz6K-aJKu0IpGsLpBg', 'message' => 'Testing MadelineProto!']);
    }
    yield $MadelineProto->echo('OK, done!');
});