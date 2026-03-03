<?php
/**
 * OurProjectView - Data provider for project records
 * Returns data to be rendered by templates, not HTML directly
 */
class OurProjectView
{
    /**
     * Get all projects for listing
     * @param array $projects Array of project records from model
     * @return array Data structure containing projects and metadata
     */
    public function getListData(array $projects): array
    {
        return [
            'title' => 'Our Projects',
            'projects' => $projects,
            'action_url' => '?action=create',
            'action_label' => 'Add New Project'
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
            'name' => ['type' => 'text', 'label' => 'Project Name', 'required' => true],
            'description' => ['type' => 'textarea', 'label' => 'Description'],
            'photo' => ['type' => 'file', 'label' => 'Photo']
        ];
        
        return [
            'title' => 'Add Project',
            'fields' => array_merge($defaultFields, $formFields),
            'submit_label' => 'Add Project',
            'back_url' => '?action=index',
            'back_label' => 'Back to List',
            'enctype' => 'multipart/form-data'
        ];
    }
}