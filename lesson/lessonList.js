const btnGroup = document.getElementById('btnGroup');
        const doDelete = document.getElementById('delete');
        const checkboxes = document.querySelectorAll('.checkbox');
        const selectAll = document.getElementById('selectAll');

        // 如果selectAll被選取，則下方所有checkbox都要被選取，並且出現刪除按鈕
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(function(checkbox) {
                // 當selectAll被選取 等於 所有(foreach)checkbox被選取
                checkbox.checked = selectAll.checked;
            })
            btnStatus();
        });

        // 如果checkbox被選取，則出現刪除按鈕
        // 因為checkboxes是一個NodeList所以無法直接對checkboxes進行監聽
        // 需要先將資料個別取出(forEach)才能進行監聽
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                btnStatus();
            });

        })

        // 如果所有checkbox都被選取，則selectAll被選取，並且出現刪除按鈕
        function btnStatus() {
            // 判斷是否有任何一個 checkbox 被選中
            const checkboxChecked = Array.from(checkboxes).some(function(checkbox) {
                return checkbox.checked;
            });

            // 判斷是否所有的 checkbox 都被選中
            const allCheckboxesChecked = Array.from(checkboxes).every(function(checkbox) {
                return checkbox.checked;
            });

            // 因為只要有checkbox被勾選，這個狀態就該出現，因此判斷checkboxChecked的狀態就好
            btnGroup.classList.toggle('btn-group', checkboxChecked);
            doDelete.classList.toggle('d-none', !checkboxChecked);

            // 如果所有 checkbox 都被選中，勾選 selectAll；否則，取消勾選 selectAll
            selectAll.checked = allCheckboxesChecked;
        };

        // 監聽被選取的checkbox
        doDelete.addEventListener('click', function() {
            const selectedIds = Array.from(checkboxes)
                // 篩選出符合被選取的checkboxes
                .filter(function(checkboxes) {
                    return checkboxes.checked;
                })
                // 將被篩選出來的checkboxes放入新的陣列
                .map(function(checkboxes) {
                    return checkboxes.id;
                });
            const modalBtnY = document.getElementById('modalBtnY');
            modalBtnY.addEventListener('click', function() {
                // 判斷如果陣列內的長度大於0則執行API
                if (selectedIds.length > 0) {
                    $.ajax({
                        type: 'GET',
                        url: 'doDeleteLesson.php',
                        data: {
                            id: selectedIds
                        },
                        success: function(response) {
                            // console.log(response);
                        },
                        error: function(error) {
                            console.error('批次刪除失敗', error);
                        }
                    });
                }
            })
        });