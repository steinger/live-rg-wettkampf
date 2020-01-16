<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Event as Event;
use ZBateson\MailMimeParser\MailMimeParser;

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
     * @link https://mail-mime-parser.org/
     *
     * @return mixed
     */
    public function handle()
    {
      // read from stdin
      $fd = fopen("php://stdin", "r");
        $parser = new MailMimeParser();
        $message = $parser->parse($fd);
      fclose($fd);
      $attachments = $message->getAllAttachmentParts();
      foreach ($attachments as $part)
      {
         $fname = "";
         if (preg_match('/(Rangliste-)(\d*)(.pdf)/',  $part->getFilename()))
         {
           $fname = $part->getFilename();
           $stream = $part->getContent();
           Storage::put('public/'.$fname, $stream);
           $this->updateEvent($fname);
           Log::info("Upload File: ". $fname);
         }
      }
    }

    /**
     * updateEvent update ranking on event db
     * @param string $file Name of attachment file
     */
    public function updateEvent($file)
    {
        $event = new Event;
        $last_id = $event->max('id');
        $data_update = $event->find($last_id);
        $data_update['file'] = $file;
        $data_update->save();
    }
}
