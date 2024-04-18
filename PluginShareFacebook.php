<?php
class PluginShareFacebook{
  function __construct() {
    wfPlugin::includeonce('wf/yml');
    wfPlugin::enable('icons/bootstrap_v1_8_1');
  }
  public function page_demo(){
    wfPlugin::enable('share/facebook');
    $widget = wfDocument::createWidget('share/facebook', 'button_share_page');
    wfDocument::renderElement(array($widget));
  }
  public function widget_button_share_page($data){
    $data = new PluginWfArray($data);
    if(!$data->get('data/u')){
      if(wfRequest::get('u')){
        $data->set('data/u', wfRequest::get('u'));
      }else{
        $data->set('data/u', wfServer::calcUrl(true));
      }
    }
    $data->set('data/href', 'http://www.facebook.com/sharer/sharer.php?u='.$data->get('data/u'));
    $element = wfDocument::getElementFromFolder(__DIR__, __FUNCTION__);
    $element->setByTag($data->get('data'));
    wfDocument::renderElement($element);
  }
}