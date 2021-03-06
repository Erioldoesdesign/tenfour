<?php

namespace TenFour\Mail;

use TenFour\Models\Organization;
use TenFour\Http\Transformers\UserTransformer;
use TenFour\Services\URLFactory;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckIn extends Mailable
{
    use Queueable, SerializesModels;

    protected $check_in;
    protected $organization;
    protected $creator;
    protected $contact;
    protected $user;
    protected $reply_token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $check_in, array $organization, array $creator, array $contact, array $user, string $reply_token)
    {
        $this->check_in = $check_in;
        $this->organization = $organization;
        $this->creator = $creator;
        $this->contact = $contact;
        $this->user = $user;
        $this->reply_token = $reply_token;
    }

    public function getFromAddress()
    {
        $domain = str_replace('app.', '', config('tenfour.domain'));
        return 'checkin+' . $this->check_in['id'] .'@'. $domain;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $org = Organization::findOrFail($this->organization['id']);

        $client_url = $org->url();
        $from_address = $this->getFromAddress();

        $profile_picture = $this->creator['profile_picture'];
        $initials = UserTransformer::generateInitials($this->creator['name']);
        $subject = str_limit($this->check_in['message'], $limit = 50, $end = '...');

        $check_in_url = URLFactory::makeCheckInURL(
            $org,
            $this->check_in['id'],
            $this->user['id'],
            $this->reply_token);

        $has_custom_answers = false;

        if ($this->check_in['answers']) {
          foreach ($this->check_in['answers'] as $index => $answer) {
              $this->check_in['answers'][$index]['url'] = URLFactory::makeCheckInURL(
                  $org,
                  $this->check_in['id'],
                  $this->user['id'],
                  $this->reply_token,
                  $index);

              if ($answer['type'] == 'custom') {
                $has_custom_answers = true;
              }
          }
        }

        $unsubscribe_url = URLFactory::makeUnsubscribeURL(
            $org,
            $this->contact['contact'],
            $this->contact['unsubscribe_token']);

        return $this->view('emails.checkin')
                    ->text('emails.checkin_plain')
                    ->with([
                        'msg'               => $this->check_in['message'],
                        'check_in_url'      => $check_in_url,
                        'profile_picture'   => $profile_picture,
                        'initials'          => $initials,
                        'answers'           => $this->check_in['answers'],
                        'org_subdomain'     => $this->organization['subdomain'],
                        'org_name'          => $this->organization['name'],
                        'author'            => $this->creator['name'],
                        // 'answer_url_no'     => $answer_url_no,
                        // 'answer_url_yes'    => $answer_url_yes,
                        // 'answer_url'        => $answer_url,
                        // 'reply_url'         => $reply_url,
                        'has_custom_answers'=> $has_custom_answers,
                        'unsubscribe_url'   => $unsubscribe_url,
                    ])
                    ->subject($subject)
                    ->from($from_address, $this->creator['name'])
                    ->replyTo($from_address, $this->creator['name']);
    }
}
