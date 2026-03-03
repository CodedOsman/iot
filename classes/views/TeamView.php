<?php
/**
 * TeamView - Data provider for team member records
 * Returns data to be rendered by templates, not HTML directly
 */
class TeamView
{
    /**
     * Get all team members for listing
     * @param array $teams Array of team member records from model
     * @return array Data structure containing teams and metadata
     */
    public function getListData(array $teams): array
    {
        return [
            'title' => 'Team Members',
            'teams' => $teams,
            'action_url' => '?action=create',
            'action_label' => 'Add New Team Member'
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
            'name' => ['type' => 'text', 'label' => 'Name', 'required' => true],
            'position' => ['type' => 'text', 'label' => 'Position', 'required' => true],
            'photo' => ['type' => 'file', 'label' => 'Photo'],
            'facebook' => ['type' => 'url', 'label' => 'Facebook'],
            'instagram' => ['type' => 'url', 'label' => 'Instagram'],
            'twitter' => ['type' => 'url', 'label' => 'Twitter'],
            'linkedin' => ['type' => 'url', 'label' => 'LinkedIn']
        ];
        
        return [
            'title' => 'Add Team Member',
            'fields' => array_merge($defaultFields, $formFields),
            'submit_label' => 'Add Team Member',
            'back_url' => '?action=index',
            'back_label' => 'Back to List',
            'enctype' => 'multipart/form-data'
        ];
    }
}