function moveUp(obj)  
{  
    var current=$(obj).parent().parent();  
    var prev=current.prev();  
    if(current.index()>1)  
    {  
        current.insertBefore(prev);  
    }  
}  
function moveDown(obj)  
{  
    var current=$(obj).parent().parent();  
    var next=current.next();  
    if(next)  
    {  
        current.insertAfter(next);  
    }  
}  