<?php
/**
 * PartnerView - Data provider for partner records
 * Returns data to be rendered by templates, not HTML directly
 */
class PartnerView
{
    /**
     * Get all partners for listing
     * @param array $partners Array of partner records from model
     * @return array Data structure containing partners and metadata
     */
    public function getListData(array $partners): array
    {
        return [
            'title' => 'Partners',
            'partners' => $partners,
            'action_url' => '?action=create',
            'action_label' => 'Add New Partner'
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
            'name' => ['type' => 'text', 'label' => 'Partner Name', 'required' => true],
            'logo' => ['type' => 'text', 'label' => 'Logo URL'],
            'website' => ['type' => 'url', 'label' => 'Website']
        ];
        
        return [
            'title' => 'Add Partner',
            'fields' => array_merge($defaultFields, $formFields),
            'submit_label' => 'Add Partner',
            'back_url' => '?action=index',
            'back_label' => 'Back to List'
        ];
    }
}