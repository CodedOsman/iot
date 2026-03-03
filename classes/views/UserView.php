<?php
/**
 * UserView - Data provider for user records
 * Returns data to be rendered by templates, not HTML directly
 */
class UserView
{
    /**
     * Get all users for listing
     * @param array $users Array of user records from model
     * @return array Data structure containing users and metadata
     */
    public function getListData(array $users): array
    {
        return [
            'title' => 'Users',
            'users' => $users,
            'action_url' => '?action=create',
            'action_label' => 'Add New User'
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
            'username' => ['type' => 'text', 'label' => 'Username', 'required' => true],
            'password' => ['type' => 'password', 'label' => 'Password', 'required' => true],
            'roleId' => ['type' => 'number', 'label' => 'Role ID']
        ];
        
        return [
            'title' => 'Add User',
            'fields' => array_merge($defaultFields, $formFields),
            'submit_label' => 'Add User',
            'back_url' => '?action=index',
            'back_label' => 'Back to List'
        ];
    }
}