<?php
/**
 * PrivilegeView - Data provider for privilege records
 * Returns data to be rendered by templates, not HTML directly
 */
class PrivilegeView
{
    /**
     * Get all privileges for listing
     * @param array $privileges Array of privilege records from model
     * @return array Data structure containing privileges and metadata
     */
    public function getListData(array $privileges): array
    {
        return [
            'title' => 'Privileges',
            'privileges' => $privileges,
            'action_url' => '?action=create',
            'action_label' => 'Add New Privilege'
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
            'name' => ['type' => 'text', 'label' => 'Privilege Name', 'required' => true],
            'description' => ['type' => 'textarea', 'label' => 'Description'],
            'module' => ['type' => 'text', 'label' => 'Module']
        ];
        
        return [
            'title' => 'Add Privilege',
            'fields' => array_merge($defaultFields, $formFields),
            'submit_label' => 'Add Privilege',
            'back_url' => '?action=index',
            'back_label' => 'Back to List'
        ];
    }
}