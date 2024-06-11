<?php

namespace Blomstra\SaveSortingPreferences;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\Http\RequestUtil;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ShowUserPreferredSortingController extends AbstractShowController
{
    public $serializer = PreferredSortingSerializer::class;

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);

        if ($actor->isGuest()) {
            return [];
        }

        return ['sort' => $actor->getPreference('discussion_sort')];
    }
}
