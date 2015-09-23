{$this->Session->flash()}
{$att|@print_r}
    {$this->Form->create('User')} 
 <fieldset>	
    <legend>Add new User</legend>
    {$this->Form->input('username')}
    {$this->Form->input('password',["type"=>"password"])}
    {$this->Form->input('re_password',["type"=>"password"])}
    {$this->Form->input('email')}
    {$this->Form->input("gender",$att)}
    {$this->Form->input("level",["type"=>"select","options"=>$options])}
	{$this->Form->end('Add new')}
 </fieldset>
