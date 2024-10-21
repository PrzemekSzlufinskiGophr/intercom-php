<?php

namespace Intercom\Test;

use Intercom\IntercomConversations;
use stdClass;

class IntercomConversationsTest extends TestCase
{
    public function testConversationCreate()
    {
        $this->client->method('post')->willReturn('foo');

        $conversations = new IntercomConversations($this->client);
        $this->assertSame('foo', $conversations->create([]));
    }

    public function testConversationUpdate()
    {
        $this->client->method('put')->willReturn('foo');

        $conversations = new IntercomConversations($this->client);
        $this->assertSame('foo', $conversations->updateConversation('', []));
    }

    public function testAddTagToConversation()
    {
        $this->client->method('post')->willReturn('foo');

        $conversations = new IntercomConversations($this->client);
        $this->assertSame('foo', $conversations->addTagToConversation('', []));
    }


    public function testRemoveTagFromConversation()
    {
        $this->client->method('delete')->willReturn('foo');

        $conversations = new IntercomConversations($this->client);
        $this->assertSame('foo', $conversations->removeTagFromConversation('1', '2'));
    }


    public function testConversationsList()
    {
        $this->client->method('get')->willReturn('foo');

        $users = new IntercomConversations($this->client);
        $this->assertSame('foo', $users->getConversations([]));
    }

    public function testConversationPath()
    {
        $users = new IntercomConversations($this->client);
        $this->assertSame('conversations/foo', $users->conversationPath("foo"));
    }

    public function testGetConversation()
    {
        $this->client->method('get')->willReturn('foo');

        $users = new IntercomConversations($this->client);
        $this->assertSame('foo', $users->getConversation("foo"));
    }

    public function testConversationSearch()
    {
        $this->client->method('post')->willReturn('foo');

        $conversations = new IntercomConversations($this->client);
        $this->assertSame('foo', $conversations->search([]));
    }

    public function testConversationNextSearch()
    {
        $this->client->method('nextSearchPage')->willReturn('foo');
        $query = [];
        $pages = new stdClass;
        $pages->per_page = "10";
        $pages->next = new stdClass;
        $pages->next->starting_after = "abc";

        $conversations = new IntercomConversations($this->client);
        $this->assertSame('foo', $conversations->nextSearch([], $pages));
    }

    public function testConversationReplyPath()
    {
        $users = new IntercomConversations($this->client);
        $this->assertSame('conversations/foo/reply', $users->conversationReplyPath("foo"));
    }

    public function testConversationTagsPath()
    {
        $users = new IntercomConversations($this->client);
        $this->assertSame('conversations/12345/tags', $users->conversationTagsPath("12345"));
    }

    public function testConversationTagsDeletePath()
    {
        $users = new IntercomConversations($this->client);
        $this->assertSame('conversations/12345/tags/54321', $users->conversationTagsDeletePath("12345", "54321"));
    }


    public function testReplyToConversation()
    {
        $this->client->method('post')->willReturn('foo');

        $users = new IntercomConversations($this->client);
        $this->assertSame('foo', $users->replyToConversation("bar", []));
    }
}
