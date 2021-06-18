function showMessage(Title, Body) {
  document.getElementById(
    "Messages"
  ).innerHTML = `<button type="button" id="showMessage" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#message" hidden></button>
        <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="ModalBody">
                    </div>
                    <div class="modal-footer" id="ModalFooter">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>`;
  document.getElementById("ModalLabel").textContent = Title;
  document.getElementById("ModalBody").textContent = Body;
  document.getElementById("showMessage").click();
}
