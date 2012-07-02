<?php

class Tbo_Core_Block_Messages extends Mage_Core_Block_Messages
{
    /**
     * {@inheritdoc}
     */
    protected $_messagesFirstLevelTagName = 'div';

    /**
     * Retrieve messages in HTML format
     *
     * @param   string $type
     * @return  string
     */
    public function getHtml($type=null)
    {
        $html = '';

        if ( $messages = $this->getMessages($type) ) {
            $html .= '<' . $this->_messagesFirstLevelTagName . ' id="admin_messages" class="alert alert-' . $type . '">';
            $html .= '<a class="close" data-dismiss="alert">&times;</a>';

            foreach ($messages as $message) {
                $html .= ($this->_escapeMessageFlag) ? $this->htmlEscape($message->getText()) : $message->getText();
            }

            $html .= '</' . $this->_messagesFirstLevelTagName . '>';
        }

        return $html;
    }

    /**
     * Retrieve messages in HTML format grouped by type
     *
     * @param   string $type
     * @return  string
     */
    public function getGroupedHtml()
    {
        $types = array(
            Mage_Core_Model_Message::ERROR,
            Mage_Core_Model_Message::WARNING,
            Mage_Core_Model_Message::NOTICE,
            Mage_Core_Model_Message::SUCCESS
        );
        $html = '';

        foreach ($types as $type) {
            if ( $messages = $this->getMessages($type) ) {
                $html .= '<' . $this->_messagesFirstLevelTagName . ' class="alert alert-' . $type . '">';
                $html .= '<a class="close" data-dismiss="alert">×</a>';
                
                foreach ( $messages as $message ) {
                    $html.= ($this->_escapeMessageFlag) ? $this->htmlEscape($message->getText()) : $message->getText();
                }
                
                $html .= '</' . $this->_messagesFirstLevelTagName . '>';
            }
        }

        return $html;
    }
}
