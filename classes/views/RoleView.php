<?php
/**
 * RoleView - Data provider for role records
 * Returns data to be rendered by templates, not HTML directly
 */
class RoleView
{
    /**
     * Get all roles for listing
     * @param array $roles Array of role records from model
     * @return array Data structure containing roles and metadata
     */
    public function getListData(array $roles): array
    {
        return [
            'title' => 'Roles',
            'roles' => $roles,
            'action_url' => '?action=create',
            'action_label' => 'Add New Role'
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
            'name' => ['type' => 'text', 'label' => 'Role Name', 'required' => true],
            'description' => ['type' => 'textarea', 'label' => 'Description']
        ];
        
        return [
            'title' => 'Add Role',
            'fields' => array_merge($defaultFields, $formFields),
            'submit_label' => 'Add Role',
            'back_url' => '?action=index',
            'back_label' => 'Back to List'
        ];
    }
}
