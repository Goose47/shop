import {number, object, string} from "yup";

const schema = object({
  first_name: string().required("First name is required"),
  last_name: string().required("Last name is required"),
  email: string().required("Email is required").email("Email must be a valid email address"),
  phone_number: number().typeError("Phone number must be a number"),
})

export default schema