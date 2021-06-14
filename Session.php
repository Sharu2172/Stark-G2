<?php
session_start();
//Function to redirect user to another page with preset post variables.
function location($page, $name1 = "", $value1 = "", $name2 = "", $value2 = "")
{
    $out = '
<form method="POST" id="form_id" action="' . $page . '">
    <input type="text" name="' . $name1 . '" value="' . $value1 . '" hidden>
    <input type="text" name="' . $name2 . '" value="' . $value2 . '" hidden>
</form>
<script type="text/javascript">
    document.forms[\'form_id\'].submit();
</script>
';
    echo $out;
}

//Function to only allow user's to access specific files using session array.
function Access()
{
    if (!isset($_COOKIE["uid"]) || $_COOKIE["uid"] === "") {
        echo "<script type='text/javascript'>
    alert('Please Login to Access This Page.');
</script>";
        echo location("../../");
    }
}

//Function show Message redirect user to another page with preset post variables.
function modal($mid, $title, $body, $buttonid, $button = '')
{
    $start = '
    <button type="button" id="showMessage" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $mid . '" hidden></button>
        <div class="modal fade" id="' . $mid . '" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">' . $title . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">' . $body . '</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        ';
    if ($buttonid != 'blank') {
        $submit = '<button type="button" id="' . $buttonid . '" class="btn btn-primary" data-bs-dismiss="modal">' . $button . '</button>';
    } else {
        $submit = '';
    }
    $end = '</div>
                </div>
            </div>
        </div>
        <script>document.getElementById("showMessage").click();</script>';
    $total = $start . $submit . $end;
    return $total;
}


