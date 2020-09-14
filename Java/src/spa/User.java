package spa;

public abstract class User {

	private String username, email;
	private int id;
	
	/**
	 * A method to check if a Lecturer or Student is still being considered as part
	 * of the problem.
	 * @return
	 */
	public abstract boolean isFree();
	
	/**
	 * Getting the name of the user
	 * @return the user's name
	 */
	public String getUsername() {
		return username;
	}
	
	/**
	 * Setting a user's name
	 * @param username A user's name
	 */
	public void setUsername(String username) {
		this.username = username;
	}
	
	
	/*public void setEmail(String email) {
		this.email = email;
	}*/
	
	/**
	 * Getting the user's ID
	 * @return id of the user
	 */
	public int getID() {
		return id;
	}
	
	/**
	 * Setting the user's ID
	 * @param id A user's ID
	 */
	public void setID(int id) {
		this.id = id;
	}
}
