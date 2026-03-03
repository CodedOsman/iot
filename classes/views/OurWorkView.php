<?php
/**
 * OurWorkView - Data provider for work records
 * Returns data to be rendered by templates, not HTML directly
 */
class OurWorkView
{
    /**
     * Get all works for listing
     * @param array $works Array of work records from model
     * @return array Data structure containing works and metadata
     */
    public function getListData(array $works): array
    {
        return [
            'title' => 'Our Works',
            'works' => $works,
            'action_url' => '?action=create',
            'action_label' => 'Add New Work'
        ];
    }

    /**
     * Get form data structure
     * @param array $formFields Field names and types for rendering
     * @return array Data structure for form rendering
     */
    public function getFormData(array $formFields = []): array
    {
        $defaultFields = [
            'title' => ['type' => 'text', 'label' => 'Title', 'required' => true],
            'photo' => ['type' => 'file', 'label' => 'Photo']
        ];
        
        return [
            'title' => 'Add Work',
            'fields' => array_merge($defaultFields, $formFields),
            'submit_label' => 'Add Work',
            'back_url' => '?action=index',
            'back_label' => 'Back to List',
            'enctype' => 'multipart/form-data'
        ];
    }
}