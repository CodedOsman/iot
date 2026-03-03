<?php
/**
 * CountView - Data provider for count records
 * Returns data to be rendered by templates, not HTML directly
 */
class CountView
{
    /**
     * Get all counts for listing
     * @param array $counts Array of count records from model
     * @return array Data structure containing counts and metadata
     */
    public function getListData(array $counts): array
    {
        return [
            'title' => 'Counts',
            'counts' => $counts,
            'action_url' => '?action=create',
            'action_label' => 'Add New Count'
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
            'impact' => ['type' => 'number', 'label' => 'Impact'],
            'project' => ['type' => 'number', 'label' => 'Project'],
            'member' => ['type' => 'number', 'label' => 'Member'],
            'trainees' => ['type' => 'number', 'label' => 'Trainees']
        ];
        
        return [
            'title' => 'Add Count',
            'fields' => array_merge($defaultFields, $formFields),
            'submit_label' => 'Add Count',
            'back_url' => '?action=index',
            'back_label' => 'Back to List'
        ];
    }
}