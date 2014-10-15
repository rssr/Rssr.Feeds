<?php

namespace Rssr\Feed;

/**
 * Shared functionality for ID access
 */
trait InitsIdGetKey
{
    /**
     * Intialize id key access
     * @param  \SimpleXMLElement $xml
     * @return void
     */
    public function initIdKey($xml)
    {
        $idealIdKey = $this->getKeys['id'];
        $this->getKeys['id'] = function () use($xml, $idealIdKey)
        {
            if (strlen((string)$xml->{$idealIdKey})) {
                return (string)$xml->{$idealIdKey};
            }

            return md5((string)$xml->title . (string)$xml->link);
        };
    }
}
