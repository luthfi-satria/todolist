<!DOCTYPE html>
<html>
    <?php include('header.php');?>
    <body>
        <!-- content wrapper -->
        <div id="content_wrapper">
            <div id="section1" class="wrapper text-right">
                <button
                    id="btnAdd"
                    type="button"
                    class="button"
                >
                    Add Task
                </button>
            </div>
            <div id="section2" class="wrapper">
                <div id="task_stat">
                    <div>Stats</div>
                    <div id="total">
                        total: <span id="total_count">0</span>
                    </div>
                    <div id="is_complete">
                        complete: <span id="complete_count">0</span>
                    </div>
                </div>
                <ul id="task_list"></ul>
            </div>
        </div>
        <!-- task loader -->
        <div id="task_loader">
            <div class="loader-content">
                <div>
                    <i class="fa fa-refresh fa-spin"></i>
                    Loading...
                </div>
            </div>
        </div>

        <!-- script -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>