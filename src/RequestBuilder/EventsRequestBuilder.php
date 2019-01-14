<?php

namespace Pionyr\PionyrCz\RequestBuilder;

use Pionyr\PionyrCz\Constants\EventCategory;
use Pionyr\PionyrCz\Constants\EventLocalization;
use Pionyr\PionyrCz\Entity\EventPreview;
use Pionyr\PionyrCz\Http\Response\EventsResponse;

/** @method EventsResponse send() */
class EventsRequestBuilder extends AbstractRequestBuilder
{
    /** @var int|null */
    protected $page;
    /** @var EventCategory|null */
    protected $category;
    /** @var EventLocalization|null */
    protected $localization;
    /** @var bool */
    protected $onlyByUnitAndSubunits = false;
    /** @var \DateTimeInterface|null */
    protected $dateFrom;
    /** @var \DateTimeInterface|null */
    protected $dateTo;

    public function setPage($page = null)
    {
        $this->page = $page;

        return $this;
    }

    public function setCategory(EventCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    public function setLocalization(EventLocalization $localization = null)
    {
        $this->localization = $localization;

        return $this;
    }

    /**
     * Only list events organized by current unit (whose token is used to access the data) or by its subunits.
     * @param mixed $onlyByUnitAndSubunits
     */
    public function onlyByUnitAndSubunits($onlyByUnitAndSubunits = true)
    {
        $this->onlyByUnitAndSubunits = $onlyByUnitAndSubunits;

        return $this;
    }

    public function setDateFrom(\DateTimeInterface $date = null)
    {
        $this->dateFrom = $date;

        return $this;
    }

    public function setDateTo(\DateTimeInterface $date = null)
    {
        $this->dateTo = $date;

        return $this;
    }

    protected function getPath()
    {
        return '/akce/';
    }

    protected function getQueryParams()
    {
        $params = [];
        if ($this->page !== null) {
            $params['stranka'] = $this->page;
        }
        if ($this->category !== null) {
            $params['kategorie'] = $this->category->getValue();
        }
        if ($this->localization !== null) {
            $params['lokalizace'] = $this->localization->getValue();
        }
        if ($this->onlyByUnitAndSubunits === true) {
            $params['krajske'] = '1';
        }
        if ($this->dateFrom !== null) {
            $params['datumOd'] = $this->dateFrom->format('Y-m-d');
        }
        if ($this->dateTo !== null) {
            $params['datumDo'] = $this->dateTo->format('Y-m-d');
        }

        return $params;
    }

    protected function processResponse(\stdClass $responseData)
    {
        $events = EventPreview::createFromResponseDataArray((array) $responseData->seznam);

        return EventsResponse::create($events, $responseData->celkemStranek, $responseData->celkemPolozek);
    }
}
