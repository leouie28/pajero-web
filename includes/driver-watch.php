
<?php
if(isset($_GET['cancel']))
{

}
if(isset($_GET['pickup']))
{
    $offer = $_GET['pickup'];

    $upd = "UPDATE offer SET of_stat='otw' WHERE of_id = $offer";
    if($conn->query($upd)===TRUE)
    {
        header('location:booking-active.php');
    }
    else
    {
        ?>
        <script>
            alert('Failed to respond to passenger! Please try again.');
        </script>
        <?php
    }
}

$user = $_SESSION['id'];
$pend = $conn->query("SELECT of_id FROM offer WHERE driver_id = $user AND of_stat = 'pending'");
if($pend->num_rows>0)
{
    ?>
        <div class="offer-watch">
        <div class="cus-modal last-id" data-id="1"></div>
    </div>

    <script>
        $(document).ready(function() {


            setInterval(fetchAccepted, 2000);

            function fetchAccepted(){

                swtch = $('.offer-watch .last-id').data('id');

                driver = '<?= $_SESSION['id']; ?>';
                fetch_accepted = 1;
                if(swtch == 1){
                    $.ajax({
                        url: 'backend/backend-fetch.php',
                        type: 'post',
                        data: {
                            driver: driver,
                            fetch_accepted: fetch_accepted
                        },
                        success: function(html) {
                            $('.offer-watch').html(html);
                        }
                    });
                }
                //console.log(swtch);
            }
        });
    </script>
    <?php
}
?>