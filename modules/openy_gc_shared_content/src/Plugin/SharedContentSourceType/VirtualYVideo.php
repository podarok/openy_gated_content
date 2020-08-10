<?php

namespace Drupal\openy_gc_shared_content\Plugin\SharedContentSourceType;

use Drupal\openy_gc_shared_content\SharedContentSourceTypeBase;

/**
 * Defines the SharedContentSourceType plugin for Virtual Y video.
 *
 * @SharedContentSourceType(
 *   id="gc_video",
 *   label = @Translation("Virtual Y video"),
 *   entity_type="node",
 *   entity_bundle="gc_video"
 * )
 */
class VirtualYVideo extends SharedContentSourceTypeBase {

  public function getTeaserJsonApiQueryArgs() {
    return [
      'include' => 'field_gc_video_media,field_gc_video_media.thumbnail,field_gc_video_level,field_gc_video_category',
      'sort[sortByDate][path]' => 'created',
      'sort[sortByDate][direction]' => 'DESC',
      'filter[status]' => 1,
      // TODO: add filter by new shared content field.
    ];
  }

  public function getFullJsonApiQueryArgs() {
    return [
      'include' => 'field_gc_video_media,field_gc_video_media.thumbnail,field_gc_video_level,field_gc_video_category,field_gc_video_equipment',
      'filter[status]' => 1,
      // TODO: add filter by new shared content field.
    ];
  }

  public function getExcludedRelationships() {
    return [
      'node_type',
      'revision_uid',
      'uid',
    ];
  }

  public function getIncludedRelationships() {
    return [
      'field_gc_video_category',
      'field_gc_video_equipment',
      'field_gc_video_level',
      'field_gc_video_media',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function processJsonApiData(&$data) {
    unset($data['data']['attributes']['drupal_internal__nid']);
    unset($data['data']['attributes']['drupal_internal__vid']);
  }

  /**
   * {@inheritdoc}
   */
  public function formatItem($data, $teaser = TRUE) {
    return $data['attributes']['title'];
  }

}
