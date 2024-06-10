<?php

namespace App\Kanban;

use JinoAntony\Kanban\KBoard;
use JinoAntony\Kanban\KItem;
use JinoAntony\Kanban\Kanban;

class TicketKanban extends Kanban
{
  /**
   * Get the list of boards
   *
   * @return KBoard[]
   */
  public function getBoards()
  {
    return [
      KBoard::make('open')
        ->setTitle('Open')
        ->canDragTo('in_progress'),

      KBoard::make('in_progress')
        ->setTitle('In Progress')
        ->canDragTo('closed'),

      KBoard::make('closed')
        ->setTitle('Closed')
        ->canDragTo('pending'),

      KBoard::make('pending')
        ->setTitle('Pending')
        ->canDragTo('kiv'),

      KBoard::make('kiv')
        ->setTitle('KIV')
        ->canDragTo('pending'),
    ];
  }

  /**
   * Get the data for each board
   *
   * @return array
   */
  public function data()
  {
    return [
      'open' => [KItem::make('1')->setContent('Item1'), KItem::make('2')->setContent('Item2')],
      'in_progress' => [KItem::make('3')->setContent('Item3'), KItem::make('4')->setContent('Item4')],
      'closed' => [KItem::make('5')->setContent('Item5'), KItem::make('6')->setContent('Item6')],
      'pending' => [KItem::make('5')->setContent('Item5'), KItem::make('6')->setContent('Item6')],
      'kiv' => [KItem::make('5')->setContent('Item5'), KItem::make('6')->setContent('Item6')],
    ];
  }

  public function build()
  {
    return $this->element('.kanban-board')
      ->margin('10px')
      ->width('250px');
  }
}
