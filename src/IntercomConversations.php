<?php

namespace Intercom;

use Http\Client\Exception;
use stdClass;

class IntercomConversations extends IntercomResource
{
    /**
     * Creates a Conversation.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#create-a-conversation
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function create(array $options)
    {
        return $this->client->post('conversations', $options);
    }

    /**
     * Updates a Conversation.
     *
     * @see    https://developers.intercom.com/docs/references/rest-api/api.intercom.io/conversations/updateconversation
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function updateConversation(string $id, array $options = [])
    {
        $path = $this->conversationPath($id);
        return $this->client->put(
            $path, $options);
    }


    /**
     * Add tag to a conversation.
     *
     * @see    https://developers.intercom.com/docs/references/rest-api/api.intercom.io/conversations/attachtagtoconversation
     * @param string $id
     * @param array $options
     * @return stdClass
     */
    public function addTagToConversation(string $id, array $options = [])
    {
        $path = $this->conversationTagsPath($id);
        return $this->client->post(
            $path, $options);
    }

    /**
     * Remove tag to a conversation.
     *
     * @see    https://developers.intercom.com/docs/references/rest-api/api.intercom.io/conversations/detachtagfromconversation
     * @param string $id
     * @param string $tagId
     * @param array $options
     * @return stdClass
     */
    public function removeTagFromConversation(string $id, string $tagId, array $options = [])
    {
        $path = $this->conversationTagsDeletePath($id, $tagId);
        return $this->client->delete($path, $options);
    }

    /**
     * Returns list of Conversations.
     *
     * @see    https://developers.intercom.io/reference#list-conversations
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function getConversations(array $options)
    {
        return $this->client->get('conversations', $options);
    }

    /**
     * Returns single Conversation.
     *
     * @see    https://developers.intercom.io/reference#get-a-single-conversation
     * @param  string $id
     * @param  array  $options
     * @return stdClass
     * @throws Exception
     */
    public function getConversation(string $id, array $options = [])
    {
        $path = $this->conversationPath($id);
        return $this->client->get($path, $options);
    }

    /**
     * Returns list of Conversations that match search query.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#search-for-conversations
     * @param  array  $options
     * @return stdClass
     * @throws Exception
     */
    public function search(array $options)
    {
        $path = 'conversations/search';
        return $this->client->post($path, $options);
    }

    /**
     * Returns next page of Conversations that match search query.
     *
     * @see    https://developers.intercom.com/intercom-api-reference/reference#pagination-search
     * @param  array $query
     * @param  stdClass $pages
     * @return stdClass
     * @throws Exception
     */
    public function nextSearch(array $query, stdClass $pages)
    {
        $path = 'conversations/search';
        return $this->client->nextSearchPage($path, $query, $pages);
    }

    /**
     * Creates Conversation Reply to Conversation with given ID.
     *
     * @see    https://developers.intercom.io/reference#replying-to-a-conversation
     * @param  string $id
     * @param  array  $options
     * @return stdClass
     * @throws Exception
     */
    public function replyToConversation(string $id, array $options)
    {
        $path = $this->conversationReplyPath($id);
        return $this->client->post($path, $options);
    }

    /**
     * Creates Conversation Reply to last conversation. (no need to specify Conversation ID.)
     *
     * @see    https://developers.intercom.io/reference#replying-to-users-last-conversation
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function replyToLastConversation(array $options)
    {
        $path = 'conversations/last/reply';
        return $this->client->post($path, $options);
    }

    /**
     * Marks a Conversation as read based on the given Conversation ID.
     *
     * @see    https://developers.intercom.io/reference#marking-a-conversation-as-read
     * @param  string $id
     * @return stdClass
     * @throws Exception
     */
    public function markConversationAsRead(string $id)
    {
        $path = $this->conversationPath($id);
        $data = ['read' => true];
        return $this->client->put($path, $data);
    }

    /**
     * Returns endpoint path to Conversation with given ID.
     *
     * @param  string $id
     * @return string
     */
    public function conversationPath(string $id): string
    {
        return 'conversations/' . $id;
    }

    /**
     * Returns endpoint path to Conversation Reply for Conversation with given ID.
     *
     * @param  string $id
     * @return string
     */
    public function conversationReplyPath(string $id): string
    {
        return 'conversations/' . $id . '/reply';
    }

    /**
     * Returns endpoint path to Conversation Tags for Conversation with given ID.
     *
     * @param string $id
     * @return string
     */
    public function conversationTagsPath(string $id): string
    {
        return 'conversations/' . $id . '/tags';
    }

    /**
     * Returns endpoint path to Conversation Tags for Conversation with given ID and tag ID.
     *
     * @param string $id
     * @param string $tagId
     * @return string
     */
    public function conversationTagsDeletePath(string $id, string $tagId): string
    {
        return 'conversations/' . $id . '/tags/' . $tagId;
    }
}
