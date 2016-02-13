<form method="post" action="add.php" enctype="multipart/form-data">
    <p>
              Please Enter the Band Members Name.
            </p>
            <p>
              Band Member or Affiliates Name:
            </p>
            <input type="text" name="nameMember"/>
            <p>
              Please Enter the Band Members Position. Example:Drums.
            </p>
            <p>
              Band Position:
            </p>
            <input type="text" name="bandMember"/>
            <p>
              Please Upload a Photo of the Member in gif or jpeg format. The file name should be named after the Members name. If the same file name is uploaded twice it will be overwritten! Maxium size of File is 35kb.
            </p>
            <p>
              Photo:
            </p>
            <input type="hidden" name="size" value="3500000">
            <input type="file" name="photo"> 
            <p>
              Please Enter any other information about the band member here.
            </p>
            <p>
              Other Member Information:
            </p>
<textarea rows="10" cols="35" name="aboutMember">
</textarea>
            <p>
              Please Enter any other Bands the Member has been in.
            </p>
            <p>
              Other Bands:
            </p>
            <input type="text" name="otherBands" size=30 />
            <br/>
            <br/>
            <input TYPE="submit" name="upload" title="Add data to the Database" value="Add Member"/>
          </form>