<?php
function yash_church_id(){
    echo '
    <div id="yash-church-id">
        <form>
            <input type="text"></input><br>
            <input type="submit" value="Update" id="church-id-button"></input>
        </form>
    </div>
    ';
}
$yash_church_id = "test1";
 
?>
<div id="yash-head">
    <!-- Notice Bar -->
    <div class="yash-important-note">
        <p>Before adding your shortcodes you need to go to the <a href="../wp-admin/admin.php?page=settings">Settings Page</a> to add your churches unique ID.</p>
    </div>

    <!-- Affiliate Section -->
    <div class="yash-affiliate-section">
        <p>Don't have an account with <a href="#">YetAnotherSermon.Host</a>? You can sign up now to create your account.</p>
        <a href="#" target="_blank" id="yash-affiliate-button">Sign Up Now</a>
    </div>
</div>

<div id="yash-body">
    <div class="yash-content-wrap">
        <div class="yash-header">
            <h1>Yet Another Sermon Host Plugin</h1>
            <div class="yash-header-buttons">
                <a href="https://yetanothersermon.host/users/login/" targe="_blank">Login <span class="dashicons dashicons-external"></span></a>
                <a href="https://yetanothersermon.host/_/<?php echo $yash_church_id;?>/sermons/" targe="_blank">My Church Page <span class="dashicons dashicons-external"></span></a>
            </div>
        </div>

        <!-- Left Sidebar -->
        <div class="yash-content-left">
            <div class="yash-content-left-wrap">
            <p class="yash-description">On this page you should find everything you will need to help get you started using the Yet Another Sermon Host plugin.</p>
                <h2><span class="dashicons dashicons-shortcode"></span> Shortcodes</h2>
                    <p>You can copy any of the below shortcodes by clicking them. Then paste them to a text block, shortcode widget, or in a text/code area. You can find short tutorials on the right of this page if you need help.</p>
                    <!-- Table with Shortcodes -->
                    <table class="yash-shortcode-table">
                        <tr>
                            <th><b>Shortcode</b></th>
                            <th><b>Description</b></th>
                        </tr>
                        <tr>
                            <td>[sermon_latest]</td>
                            <td>Display the latest sermon uploaded</td>
                        </tr>
                        <tr>
                            <td>[sermon_page]</td>
                            <td>Add to any page to embed your customizable sermons page.</td>
                        </tr>
                    </table>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="yash-content-right">
            <div class="yash-content-right-wrap">
                <h2><span class="dashicons dashicons-tag"></span> Church ID</h2>
                <?php echo yash_church_id(); ?>
                <h2><span class="dashicons dashicons-video-alt3"></span> Tutorial Video</h2>
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/u31qwQUeGuM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <h2><span class="dashicons dashicons-admin-links"></span> Resources</h2>
                <ul>
                    <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                    <li><a href="#">Suspendisse sed felis tristique, dignissim urna at, suscipit ante.</a></li>
                    <li><a href="#">Donec eget turpis a ex molestie porttitor eu eu felis.</a></li>
                    <li><a href="#">Suspendisse consequat ipsum at venenatis venenatis.</a></li>
                    <li><a href="#">In congue sapien elementum tincidunt egestas.</a></li>
                </ul>
            </div>

    
    </div>
</div>
<?php ;