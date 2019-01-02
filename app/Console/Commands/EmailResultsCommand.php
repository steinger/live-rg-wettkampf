<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Result as Result;
use App\Event as Event;

class EmailResultsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Email with Results, Email format:
     * Start Event:
     *  Subject : 00000
     *  Body : Name of Event
     * Input Results:
     *  Subject : [rgid number] [abbr apparatus] [startno] [name of gymnast] [category]
     *  Body : [apparatus] [Total score] [D points] [E points], optional [penalty]
     * Send mail pipe to program with  |/[absolutpath]/artisan --env=local emailresults
     *
     * @var string
     */
    protected $signature = 'emailresults';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RG parses an incoming email for results.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @link https://www.sitepoint.com/piping-emails-laravel-application
     * @link http://php.net/manual/de/ref.mailparse.php
     *
     * @return mixed
     */
    public function handle()
    {
        // read from stdin
        $fd = fopen("php://stdin", "r");
        $rawEmail = "";
        while (!feof($fd)) {
            $rawEmail .= fread($fd, 1024);
        }
        // Parse
        $mimemail = mailparse_msg_create();
        fclose($fd);
        mailparse_msg_parse($mimemail,$rawEmail);
        $struct = mailparse_msg_get_structure($mimemail);
        $info = mailparse_msg_get_part_data($mimemail);
        $data = rtrim($info['headers']['subject']);
        $data = imap_utf8($data);
        $fromEmail = $info['headers']['from'];
        $dataBody = mailparse_msg_extract_part($mimemail, $rawEmail, null);
        Log::info($fromEmail.";".$data);
        $this->InputData($data,$dataBody,$fromEmail);
    }

    /**
     * Input Results data to DB
     * @param string $emailData Email Subject Data
     * @param string $body      Email body data
     * @param string $fromEmail Email put from
     */
    public function InputData($emailData, $body, $fromEmail)
    {
        $header = explode(" ", $emailData,4);
        $body = explode("---", $body,2);
        $body = str_replace("\r\n"," ",$body[0]);
        $body = substr($body, 0, 200);
        $body = rtrim($body);
        if ($header[0] == '000000')
        {
            $event = new Event;
            $data = [];
            $data['name'] = $body;
            $data['file'] = "";
            $data['created_at'] = now();
            $data['updated_at'] = now();
            $event->insert($data);
        }
        else
        {
            $event = new Event;
            $lastEventID = $event->max('id');
            // Log::debug($fromEmail.";Info;".$header[0]);
            $result = new Result;
            // Count
            $rowCount = $result->all()->where('rgid',$header[0])->where('event_id',$lastEventID)->count();
            if ($rowCount > 0)
            {
                // Update
                $result_update = $result->where('rgid',$header[0])->where('event_id',$lastEventID)->first();
                $result_update->apparatus = $header[1];
                $result_update->startno = $header[2];
                $result_update->name = $header[3];
                $result_update->body = $body;
                $result_update->save();
            }
            else
            {
                // Insert
                $data = [];
                $data['rgid'] = $header[0];
                $data['event_id'] = $lastEventID;
                $data['apparatus'] = $header[1];
                $data['startno'] = $header[2];
                $data['name'] =  $header[3];
                $data['body'] =  $body;
                $data['created_at'] = now();
                $data['updated_at'] = now();
                $result->insert($data);
            }
        }
    }
}
