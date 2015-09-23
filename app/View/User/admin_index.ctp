<h1>Blog posts</h1> 
<h1>{$this->Html->link('Add New Post',"/posts/add")}</h1> 
<table> 
<tr> 
    <th>Id</th> 
    <th>Username</th> 
    <th>Email</th> 
    <th>Level</th>
    <th>Action</th>
 </tr> 
<!-- Here's where we loop through our $posts array, printing out post info --> 
 
    {section name=item loop=$users} 
    <tr> 
        <td>{$users[item]['User'].id}</td> 
        <td> 
        <a href="">{$users[item]['User'].username}</a> 
     
        </td> 
        <td> 
            <a href="">{$users[item]['User'].email}</a> 
     
        </td>
        <td>
        	{if $users[item]['User'].level eq 1}
        	 	Administrator
        	{else}
        		Assistant
        	{/if}
        </td> 
        <td>
        
        </td>
    </tr> 
    {/section} 
</table> 
test taset
sdgasdgsdfgdasfgdfsgsdfgs