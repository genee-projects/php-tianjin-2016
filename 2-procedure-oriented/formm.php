<form>
Name :<input type="text" name="name" />
Age : <input type="number" name="age" />
<button type="submit">Submit</button>
</form>
<?php

echo '<pre>' . print_r($_GET, true) . '</pre>';
