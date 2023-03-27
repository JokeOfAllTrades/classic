(function($)
{
    function setDirty() 
    {
        window.addEventListener('beforeunload', onBeforeUnloadCallBack);
    }

    function setClean() 
    {
        window.removeEventListener('beforeunload', onBeforeUnloadCallBack);
    }
    $(document).ready(function()
    {
        if ($('#Editbox').length > 0)
        {
            setClean();
            if (localStorage.getItem('entry') != null)
            {
                var entry = localStorage.getItem('entry');
            }
            else
            {
                var entry = $('#Editbox').value();
            }
            $('#Editbox').on('input', function()
            {
                if (entry != $('#Editbox').value()) 
                {
                    setDirty();
                } 
                else 
                {
                    setClean();
                }
            });

            $('#TheInternet').on('submit', setClean);
            //$('#TheInternet')[6].on('submit', setClean);
        }
    });
    function onBeforeUnloadCallBack(event)
    {
        if (onBeforeUnloadCallBack.caller !== SelectAction)
        {
            event.preventDefault();
            // Google Chrome requires returnValue to be set.
            event.returnValue = '';
        }
        else
        {
            // Google Chrome requires returnValue to be set.
            event.returnValue = '';
        }
    }
})(basic)
