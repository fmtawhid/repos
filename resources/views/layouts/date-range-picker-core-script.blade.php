<script src="{{ asset('assets/js/vendors/flatpickr.min.js') }}?v={{ cacheVersion()  }}"></script>

<script>
    $(() => {
        $('.date-picker').flatpickr({
            dateFormat: 'Y-m-d',
            time_24hr: true,
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    longhand: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                },
                months: {
                    shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    longhand: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                },
            },
        });

        if ($('.date-picker').length > 0) {
            $('.date-picker').on('change', function () {
                $(this).trigger('input');
            })
        }
    })
</script>
