package spa;

public abstract class User {

	private String username;
	private int id;
	
	/*
	 * A method to check if a Lecturer or Student is still being considered as part
	 * of the problem.
	 */
	public abstract boolean isFree();
	
	/*
	 * Getting the name of the user
	 */
	public String getUsername() {
		return username;
	}
	
	/*
	 * Setting a user's username
	 */
	public void setUsername(String username) {
		this.username = username;
	}
	
	/*
	 * Getting the user's ID
	 */
	public int getID() {
		return id;
	}
	
	/*
	 * Setting the user's ID
	 */
	public void setID(int id) {
		this.id = id;
	}
}
