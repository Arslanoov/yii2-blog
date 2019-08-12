<?php

namespace frontend\urls;

use blog\entities\Page;
use BadMethodCallException;
use yii\base\BaseObject;
use yii\caching\FileCache;
use yii\helpers\ArrayHelper;
use blog\readModels\PageReadRepository;
use yii\web\UrlNormalizerRedirectException;
use yii\web\UrlRuleInterface;

class PageUrlRule extends BaseObject implements UrlRuleInterface
{
    private $repository;
    private $cache;

    public function __construct(PageReadRepository $repository, FileCache $cache, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function parseRequest($manager, $request)
    {
        $path = $request->pathInfo;
        $result = $this->cache->getOrSet(['page_route', 'path' => $path], function () use ($path) {
            if (!$page = $this->repository->findBySlug($this->getPathSlug($path))) {
                return ['id' => null, 'path' => null];
            }
            return ['id' => $page->id, 'path' => $this->getPagePath($page)];
        });
        if (empty($result['id'])) {
            return false;
        }
        if ($path != $result['path']) {
            throw new UrlNormalizerRedirectException(['page/view', 'id' => $result['id']], 301);
        }
        return ['page/view', ['id' => $result['id']]];
    }

    public function createUrl($manager, $route, $params)
    {
        if ($route == 'page/view') {
            if (empty($params['id'])) {
                throw new BadMethodCallException('Empty id.');
            }
            $id = $params['id'];
            $url = $this->cache->getOrSet(['page_route', 'id' => $id], function () use ($id) {
                if (!$page = $this->repository->find($id)) {
                    return null;
                }
                return $this->getPagePath($page);
            });
            if (!$url) {
                throw new BadMethodCallException('Undefined id.');
            }
            unset($params['id']);
            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $url .= '?' . $query;
            }
            return $url;
        }
        return false;
    }

    private function getPathSlug($path): string
    {
        $chunks = explode('/', $path);
        return end($chunks);
    }

    private function getPagePath(Page $page): string
    {
        $chunks = ArrayHelper::getColumn($page->getParents()->andWhere(['>', 'depth', 0])->all(), 'slug');
        $chunks[] = $page->slug;
        return implode('/', $chunks);
    }
}