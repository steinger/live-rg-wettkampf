<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Event as Event;

class EmailRankingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * For email with attachment ranking.
     * Send mail pipe to program with |/[absolutpath]/artisan --env=local emailranking
     *
     * @var string
     */
    protected $signature = 'emailranking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RG parses an incoming email for rankings.';

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
        $mime_part = mailparse_msg_get_structure($mimemail);
        //Log::info($mime_part);
        foreach ( $mime_part as $part )
        {
            $filename = "";
            if (preg_match('/^(\d).([2-9])/', $part))
            {
                //Log::info($part);
                $body_part = mailparse_msg_get_part($mimemail, $part);
                $info = mailparse_msg_get_part_data($body_part);
                // Log::info($info);
                $filename = $info['disposition-filename'];
                if (preg_match('/(Rangliste-)(\d*)(.pdf)/', $filename))
                {
                    $dataBody = mailparse_msg_extract_part($body_part, $rawEmail, null);
                    Storage::put('public/'.$filename, $dataBody);
                    $this->UpdateEvent($filename);
                    Log::info("Upload File: ". $filename);
                }
            }
        }
    }

    /**
     * UpdateEvent update ranking on event db
     * @param string $file Name of attachment file
     */
    public function UpdateEvent($file)
    {
        $event = new Event;
        $last_id = $event->max('id');
        $data_update = $event->find($last_id);
        $data_update['file'] = $file;
        $data_update->save();
    }
}
