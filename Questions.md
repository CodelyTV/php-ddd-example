# Question

What about validating value objects that can be null?

For example, the videw review text can be null, 
 - Should we allow null values in the value object?
 - Should we allow null values in the Model/Entity/AggregateRoot 


 # Next step

 - Create a listener for review created
    - The listener will check if is validated, and if not, will send an email
    - To send the email, crear use_case that creates a notification
        - The notification created listener will send an email to the validators

- Create endpoint to validate reviews
    - Endpoint to validate reviews
        - Approved?
            - Event ReviewApproved is dispatched
            - A listener listen this to calculate the course average rating
        - Rejected
            - Event ReviewRejected is dispatched
            - A listener can send a notification to the creator
