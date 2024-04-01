<?php

namespace Everest\Transformers\Api\Client;

use Everest\Models\Ticket;
use League\Fractal\Resource\Collection;
use Everest\Transformers\Api\Transformer;
use League\Fractal\Resource\NullResource;

class TicketTransformer extends Transformer
{
    /**
     * List of resources that can be included.
     */
    protected array $availableIncludes = ['messages'];

    public function getResourceName(): string
    {
        return Ticket::RESOURCE_NAME;
    }

    /**
     * Return's a user's ticket in an API response format.
     */
    public function transform(Ticket $model): array
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'status' => $model->status,
            'created_at' => self::formatTimestamp($model->created_at),
            'updated_at' => self::formatTimestamp($model->updated_at),
        ];
    }

    /**
     * Return the messages associated with this ticket.
     */
    public function includeMessages(Ticket $ticket): Collection|NullResource
    {
        return $this->collection($ticket->messages, new TicketMessageTransformer());
    }
}
