<?php

namespace htmlRenderer;

use document\DocumentInterface;
use document\DocumentElement;

class HtmlRenderer
{
    public function export(DocumentInterface $document): string
    {
        $documentItems = $document->getItems();
        $documentItemsStr = $this->renderDocumentItems($documentItems);
        $htmlDocument = $this->renderDocument($document->getTitle(), $documentItemsStr);

        return $htmlDocument;
    }

    /**
     * @param DocumentElement[] $documentsItems
     * @return string
     */
    private function renderDocumentItems(array $documentsItems): string
    {
        $result = '';
        foreach ($documentsItems as $documentsItem)
        {
            $result .= htmlspecialchars($documentsItem->toString());
        }

        return $result;
    }

    private function renderDocument(string $title, string $body): string
    {
        return <<<EOF
                <!DOCTYPE html>
                <html>
                  <head>
                    <title>{$title}</title>
                  </head>
                  <body>
                    {$body}
                  </body>
                </html>
EOF;
    }
}