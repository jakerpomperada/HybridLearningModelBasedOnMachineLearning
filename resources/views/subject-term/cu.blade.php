<div id="cu_subject_term_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Subject Term</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="field-1" class="form-label">Academic Term:</label>
                            <select name=academic_terms" id="academic_terms" class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="field-2" class="form-label">Semester:</label>
                            <select name=semesters" id="semesters" class="form-control">
                                <option value="-1">Select Semester</option>
                                <option value="1st">First Semester</option>
                                <option value="2nd">Second Semester</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="field-1" class="form-label">Course:</label>
                            <select name=courses" id="courses" class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="field-2" class="form-label">Year Level:</label>
                            <select name=year_level" id="year_level" class="form-control"></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="field-3" class="form-label">Subject:</label>
                            <select name=subjects" id="subjects" class="form-control"></select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light" id="save_subject_term">Save changes</button>
            </div>
        </div>
    </div>
</div>

