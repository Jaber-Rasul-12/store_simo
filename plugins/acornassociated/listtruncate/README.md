# About
AcornAssociated plugin to add a toggleable switch as a column type to the backend.


# Install ListTruncate

```bash 
cd plugins/ ; mkdir -p acornassociated ; cd acornassociated ; git clone git@dev.acornassociated.org:justice-project/listtruncate.git ; cd ../../; 
```


## Usage

To add a switch column to a list; set the `type` of the column to `acornassociated-list-truncate`. 

Example:
```yaml
your_column:
    label: 'Your Label'
    # Define the type as "acornassociated-list-truncate" to enable this functionality
    type: acornassociated-list-truncate
    
    truncate: true 
    truncate_limit: 12
    show_more: true 
```


## Author

Jaber Rasul