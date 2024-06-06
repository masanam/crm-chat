<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\WebSocketController;

class WebSocketServer extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'websocket:start';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Start the WebSocket server';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $server = IoServer::factory(new HttpServer(new WsServer(new WebSocketController())), 9123);
    $this->info('WebSocket server started');
    $server->run();
  }
}
