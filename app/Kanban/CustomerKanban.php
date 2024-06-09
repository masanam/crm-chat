<?php

namespace App\Kanban;

use JinoAntony\Kanban\KBoard;
use JinoAntony\Kanban\KItem;
use JinoAntony\Kanban\Kanban;

class CustomerKanban extends Kanban
{
    /**
     * Get the list of boards
     *
     * @return KBoard[]
     */
    public function getBoards()
    {
        return [
            KBoard::make('board1')
                ->setTitle('Board1 title')
                ->canDragTo('board2'),

            KBoard::make('board2')
                ->setTitle('Board2 title')
                ->canDragTo('board3'),

            KBoard::make('board3')
                ->setTitle('Board3 title')
                ->canDragTo('board2')
                ->canDragTo('board1'),
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
            'board1' => [
                KItem::make('1')
                    ->setContent('Item1'),
                KItem::make('2')
                    ->setContent('Item2'),
            ],
            'board2' => [
                KItem::make('3')
                    ->setContent('Item3'),
                KItem::make('4')
                    ->setContent('Item4'),
            ],
            'board3' => [
                KItem::make('5')
                    ->setContent('Item5'),
                KItem::make('6')
                    ->setContent('Item6'),
            ],
        ];
    }

    public function build()
    {
        return $this->element('.kanban-board')
            ->margin('20px')
            ->width('365px');
    }

}