<?php

namespace Icinga\Module\Customactions\Web\Form;

use Icinga\Module\Neteye\Web\Form\BaseDeleteForm;
use Icinga\Module\Customactions\Repository\FilterRepository;
use Icinga\Security\SecurityException;

class FilterDeleteForm extends BaseDeleteForm
{
    public function __construct()
    {
        $this->repository = new FilterRepository();
        parent::__construct();
    }

    /**
     * This method will be used to validate, if user is allowed to access the object or not
     * in below mode during delete action.
     * This method is written in the BASE FORM, which is now overridden here to validate if the user has permissions
     * to edit the object or not.
     * @throws \Exception
     */
    protected function validateUserAccessPermission()
    {
        if (!empty($this->object)) {
            if (!$this->repository->userAccessValidationForFilterObject($this->id)) {
                throw new SecurityException('No permission for this filter');
            }
        }
    }
}
