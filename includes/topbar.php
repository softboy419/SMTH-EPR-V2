<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="topbar">

    <div class="hospital-name">
        🏥 <strong>Save Me Teaching Hospital</strong><br>
        <small>Electronic Patient Record System</small>
    </div>

    <div class="topbar-right">

        <div class="user-info">
            <i class="bi bi-person-circle"></i>
            <?php echo $_SESSION['username']; ?>
        </div>

        <div class="datetime">
            <i class="bi bi-calendar-event"></i>
            <span id="clock"></span>
        </div>

    </div>

</div>

<script>
function updateClock(){

    const now = new Date();

    document.getElementById("clock").innerHTML =
        now.toLocaleDateString() + " | " +
        now.toLocaleTimeString();

}

updateClock();

setInterval(updateClock,1000);

</script>