<?php
declare(strict_types=1);

namespace Nekit44\AdmitadPhpApi\Methods;

use Nekit44\AdmitadPhpApi\Api;
use Nekit44\AdmitadPhpApi\Constants\Method;
use stdClass;

class Programs extends BaseMethod
{

    /**
     * @param int|null $id
     * @param int $limit
     * @param int $offset
     * @param array $params
     * @return stdClass
     * @throws \Nekit44\AdmitadPhpApi\Exception\ApiException
     */
    public function advcampaigns(?int $id = null, int $limit = 5, int $offset = 0, array $params = []): stdClass
    {
        $url = $id ? "/advcampaigns/{$id}/" : "/advcampaigns/";
        return $this->api->methods($url,Method::GET, $limit, $offset, $params);
    }

    /**
     * @param int $websiteId
     * @param int $limit
     * @param int $offset
     * @param array $params [
     *      connection_status [active, pending, declined],
     *      has_tool [deeplink, products, retag, lost_orders, coupons, basket_tracking, tracking_in_mobile_site,  tracking_in_mobile_app, vendor_bonus]
     * ]
     * @return stdClass
     * @throws \Nekit44\AdmitadPhpApi\Exception\ApiException
     */
    public function advcampaignsWebsite(int $websiteId, int $limit = 5, int $offset = 0, array $params = []): stdClass
    {
        $url = "/advcampaigns/website/{$websiteId}/";
        return $this->api->methods($url, Method::GET, $limit, $offset, $params);
    }

    /**
     * @param int $siteId
     * @param int $partnerProgramId
     * @return stdClass
     * @throws \Nekit44\AdmitadPhpApi\Exception\ApiException
     */
    public function advcampaignsAttach(int $siteId, int $partnerProgramId)
    {
        return $this->manageAdvcampaigns($siteId, $partnerProgramId, 'attach');
    }

    /**
     * @param int $siteId
     * @param int $partnerProgramId
     * @return stdClass
     * @throws \Nekit44\AdmitadPhpApi\Exception\ApiException
     */
    public function advcampaignsDetach(int $siteId, int $partnerProgramId)
    {
        return $this->manageAdvcampaigns($siteId, $partnerProgramId, 'detach');
    }

    /**
     * @param int $siteId
     * @param int $partnerProgramId
     * @return stdClass
     * @throws \Nekit44\AdmitadPhpApi\Exception\ApiException
     */
    private function manageAdvcampaigns(int $siteId, int $partnerProgramId, string $typeAction): stdClass
    {
        $url = "/advcampaigns/{$siteId}/{$typeAction}/{$partnerProgramId}/";
        return $this->api->methods($url, Method::POST);
    }
}