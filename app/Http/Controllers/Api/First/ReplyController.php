<?php

namespace TenFour\Http\Controllers\Api\First;

use TenFour\Contracts\Repositories\ReplyRepository;
use TenFour\Contracts\Repositories\CheckInRepository;
use TenFour\Http\Requests\Reply\GetReplyRequest;
use TenFour\Http\Requests\Reply\AddReplyRequest;
use TenFour\Http\Requests\Reply\CreateReplyRequest;
use TenFour\Http\Requests\Reply\UpdateReplyRequest;
use TenFour\Http\Transformers\ReplyTransformer;
use TenFour\Http\Response;
use TenFour\Notifications\CheckInChanged;
use TenFour\Models\CheckIn;

use Illuminate\Support\Facades\Notification;
use Dingo\Api\Auth\Auth;

/**
 * @Resource("Replies", uri="/api/v1/organizations/{org_id}/checkins/{check_in_id}/replies")
 */
class ReplyController extends ApiController
{
    public function __construct(replyRepository $reply, CheckInRepository $check_ins, Auth $auth, Response $response)
    {
        $this->reply = $reply;
        $this->check_ins = $check_ins;
        $this->auth = $auth;
        $this->response = $response;
    }

    /**
     * Get a single reply
     *
     * @Get("/{reply_id}")
     * @Versions({"v1"})
     * @Parameters({
     *   @Parameter("check_in_id", type="number", required=true, description="Check-in id"),
     *   @Parameter("reply_id", type="number", required=true, description="Reply id")
     * })
     *
     * @Request(headers={"Authorization": "Bearer token"})
     * @Response(200, body={
     *     "reply": {
     *          "answer": null,
     *          "contact": {
     *               "id": 3,
     *               "uri": "/contacts/3"
     *           },
     *           "created_at": "2016-04-15 20:01:55",
     *           "id": 1,
     *           "location_text": null,
     *           "message": "I am OK",
     *           "message_id": null,
     *           "checkin": {
     *               "id": 4,
     *               "uri": "/organizations/2/checkins/4"
     *           },
     *           "updated_at": null,
     *           "uri": "/organizations/2/checkins/4/reply/1",
     *           "user": {
     *               "id": 1,
     *               "uri": "/users/1"
     *           },
     *     }
     * })
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function find(GetReplyRequest $request, $organization_id, $check_in_id, $reply_id)
    {
        $reply = $this->reply->find($reply_id);
        return $this->response->item($reply, new ReplyTransformer, 'reply');
    }

    /**
     * Create a reply
     *
     * @todo Consider merging this with `addReply` and turning it into a resource
     *
     * @param Request $request
     * @return Response
     *
     */
    public function create(CreateReplyRequest $request, $organization_id)
    {
        $reply = $this->reply->create(
          $request->input() + [
            'user_id' => $this->auth->user()['id']
          ]
        );

        $this->notifyCheckInChanged($request['check_in_id']);

        return $this->response->item($reply, new ReplyTransformer, 'reply');
    }

    private function notifyCheckInChanged($check_in_id)
    {
        $check_in = CheckIn::findOrFail($check_in_id);

        Notification::send($check_in->recipients, new CheckInChanged($check_in->toArray()));
        Notification::send($check_in->user, new CheckInChanged($check_in->toArray()));
    }

    /**
     * Add reply
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Parameters({
     *   @Parameter("check_in_id", type="number", required=true, description="Check-in id")
     * })
     *
     * @Request({
     *     "answer": "yes",
     *     "message": "I am OK"
     * }, headers={"Authorization": "Bearer token"})
     * @Response(200, body={
     *     "reply": {
     *         "answer": "yes",
     *         "created_at": "2016-03-15 20:27:54",
     *         "id": 6,
     *         "message": "I am OK",
     *         "checkin": {
     *             "id": 1,
     *             "uri": "/organizations/2/checkins/1"
     *         },
     *         "updated_at": "2016-03-15 20:27:54",
     *         "uri": "/organizations/2/checkins/1/reply/6",
     *         "user": {
     *             "id": 5,
     *             "uri": "/users/5"
     *         },
     *         "user_id": 5
     *     }
     * })
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addReply(AddReplyRequest $request, $organization_id, $check_in_id)
    {
        $user_id = $this->auth->user()['id'];
        $reply = $this->reply->addReply(
          $request->input() + [
            'user_id' => $user_id,
            'check_in_id' => $check_in_id
          ], $check_in_id);

        // Update response status
        $this->check_ins->updateRecipientStatus($check_in_id, $user_id, 'replied');

        $this->notifyCheckInChanged($check_in_id);

        return $this->response->item($reply, new ReplyTransformer, 'reply');
    }

    public function addReplyFromToken(AddReplyRequest $request, $id)
    {
        $user_id = $this->auth->user()['id'];

        $user_id = $this->check_ins->getUserFromReplyToken($request->get('token'));

        $reply = $this->reply->addReply(
          $request->input() + [
            'user_id' => $user_id,
            'check_in_id' => $id
          ], $id);

        $this->notifyCheckInChanged($id);

        // Update response status
        $this->check_ins->updateRecipientStatus($id, $user_id, 'replied');
        return $this->response->item($reply, new ReplyTransformer, 'reply');
    }

    /**
     * List check-in replies
     *
     * @Get("/")
     * @Versions({"v1"})
     * @Parameters({
     *   @Parameter("check_in_id", type="number", required=true, description="Check-in id")
     * })
     *
     * @Request(headers={"Authorization": "Bearer token"})
     * @Response(200, body={
     *     "replies": {
     *         {
     *             "answer": null,
     *             "contact": {
     *                 "id": 1,
     *                 "uri": "/contacts/1"
     *             },
     *             "created_at": "2017-03-16 10:41:11",
     *             "id": 1,
     *             "location_text": null,
     *             "message": "I am OK",
     *             "message_id": null,
     *             "checkin": {
     *                 "id": 1,
     *                 "uri": "/organizations/2/checkins/1"
     *             },
     *             "updated_at": null,
     *             "uri": "/organizations/2/checkins/1/reply/1",
     *             "user": {
     *                 "config_profile_reviewed": 0,
     *                 "config_self_test_sent": 0,
     *                 "created_at": null,
     *                 "description": "Test user",
     *                 "first_time_login": 1,
     *                 "id": 1,
     *                 "initials": "TU",
     *                 "invite_sent": 0,
     *                 "name": "Test user",
     *                 "organization_id": 2,
     *                 "person_type": "user",
     *                 "profile_picture": null,
     *                 "role": "member",
     *                 "updated_at": null,
     *                 "uri": "/users/1"
     *             },
     *         },
     *         {
     *             "answer": null,
     *             "contact": {
     *                 "id": 4,
     *                 "uri": "/contacts/4"
     *             },
     *             "created_at": "2017-03-16 10:41:11",
     *             "id": 3,
     *             "location_text": null,
     *             "message": "Latest answer",
     *             "message_id": null,
     *             "checkin": {
     *                 "id": 1,
     *                 "uri": "/organizations/2/checkins/1"
     *             },
     *             "updated_at": null,
     *             "uri": "/organizations/2/checkins/1/reply/3",
     *             "user": {
     *                 "config_profile_reviewed": 0,
     *                 "config_self_test_sent": 0,
     *                 "created_at": null,
     *                 "description": "Org owner",
     *                 "first_time_login": 1,
     *                 "id": 4,
     *                 "initials": "OO",
     *                 "invite_sent": 0,
     *                 "name": "Org owner",
     *                 "organization_id": 2,
     *                 "person_type": "user",
     *                 "profile_picture": null,
     *                 "role": "owner",
     *                 "updated_at": null,
     *                 "uri": "/users/4"
     *             },
     *         }
     *     }
     * })
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listReplies(GetReplyRequest $request, $organization_id, $check_in_id)
    {
        return $this->response->collection($this->reply->getReplies($check_in_id, $request->query('users'), $request->query('contacts')),
                                     new ReplyTransformer, 'replies');
    }

    /**
     * Update a reply
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function update(UpdateReplyRequest $request, $organization_id, $check_in_id, $reply_id)
    {
        $reply = $this->reply->update($request->all(), $reply_id);

        $this->notifyCheckInChanged($check_in_id);

        return $this->response->item($reply, new ReplyTransformer, 'reply');
    }
}
