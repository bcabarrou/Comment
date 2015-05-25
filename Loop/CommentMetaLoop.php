<?php

namespace Comment\Loop;

use Thelia\Core\Template\Element\ArraySearchLoopInterface;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Model\MetaData;
use Thelia\Model\MetaDataQuery;

/**
 * Loop on comments metadata.
 */
class CommentMetaLoop extends BaseLoop implements ArraySearchLoopInterface
{
    /**
     * Metadata master key.
     */
    const META_KEY = 'COMMENT_RATING';

    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createAnyTypeArgument('key'),
            Argument::createIntTypeArgument('id')
        );
    }

    public function buildArray()
    {
        return MetaDataQuery::getVal(
            static::META_KEY,
            $this->getArgValue('key'),
            $this->getArgValue('id')
        );
    }

    public function parseResults(LoopResult $loopResult)
    {
        $metas = $loopResult->getResultDataCollection();

        $loopResultRow = new LoopResultRow();
        $loopResultRow->set('RATING', $metas['rating']);
        $loopResultRow->set('COUNT', $metas['count']);

        $loopResult->addRow($loopResultRow);

        return $loopResult;
    }
}
