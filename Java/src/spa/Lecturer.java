package spa;

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Lecturer extends User {

	private int capacity;
	//private int office;
	private List<Student> preferenceList;
	private List<Project> listOfProjects;
	private List<Student> listOfSupervisees;
	
	/**
	 * Reading the information of the Lecturer
	 * @param i
	 * @param s
	 */
	public Lecturer(int id, Scanner s) {
		preferenceList = new ArrayList<Student>();
		listOfProjects = new ArrayList<Project>();
		listOfSupervisees = new ArrayList<Student>();
		setID(id);
		this.capacity = s.nextInt();
		this.setUsername(s.next());
		//this.setEmail(s.next());
		s.nextLine();
	}
	
	/**
	 * Adding a student to the Lecturer's preference list
	 * @param si A student
	 */
	public void addStudentToPreferenceList(Student si) {
		preferenceList.add(si);
	}
	
	/**
	 * Adding a project to the list of those supervised by
	 * the Lecturer
	 * @param pj A project
	 */
	public void addProject(Project pj) {
		listOfProjects.add(pj);
	}
	
	/**
	 * Adding a student to the list of those assigned to a project
	 * that belongs to the Lecturer
	 * @param si A student
	 */
	public void addSupervisee(Student si) {
		listOfSupervisees.add(si);
	}
	
	/**
	 * Returning the size of the Lecturer's preference list
	 * @return
	 */
	public int totalPreferences() {
		return preferenceList.size();
	}
	
	/**
	 * Finding if the Lecturer offers a certain project
	 * @param pj A project
	 * @return True if the Lecturer offers this project; False if not
	 */
	public boolean offersProject(Project pj) {
		return listOfProjects.contains(pj);
	}
	
	/**
	 * Returning the size of the lecturer's preference list
	 * @return
	 */
	public int getTotalPreferences() {
		return this.preferenceList.size();
	}
	
	/**
	 * Getting the number of students this Lecturer can supervise
	 * @return
	 */
	public int getCapacity() {
		return capacity;
	}
	
	/**
	 * Setting the number of students this Lecturer can supervise
	 * @param capacity
	 */
	public void setCapacity(int capacity) {
		this.capacity = capacity;
	}
	
	/*public int getOffice() {
		return office;
	}*/
	
	/*public void setOffice(int office) {
	  	this.office = office;
	}*/
	
	/**
	 * Checking if a Lecturer is able to supervise any more students
	 * @return
	 */
	public boolean isFree() {
		if(listOfSupervisees.size() < capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * If it is not possible that a stable matching includes a student assigned
	 * to this project, the provisional assignment is broken
	 * @param si A student
	 */
	public void breakProvisionalAssignment(Student si) {
		this.listOfSupervisees.remove(si);
	}
	
	/**
	 * Checking if the number of students assigned to this Lecturer is greater
	 * than the total capacity allowed by their projects
	 * @return True if supervisees exceeds allowed capacity; False if not
	 */
	public boolean isOverSubscribed() {
		if(listOfSupervisees.size() > capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Checking if the number of students assigned to this Lecturer matches
	 * the total capacity allowed by their projects
	 * @return True if supervisees matches capacity; False if not
	 */
	public boolean isFull() {
		if(listOfSupervisees.size() == capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Getting the student assigned to this Lecturer who is lowest on the 
	 * preference list
	 * @return
	 */
	public Student getWorstAssignedStudent() {
		int i = -1;
		for(Student si : listOfSupervisees) {
			if(preferenceList.indexOf(si) > i) {
				i = preferenceList.indexOf(si);
			}
		}
		return preferenceList.get(i);
	}
	
	/**
	 * Getting the index of a student
	 * @param si A student
	 * @return Student si's index
	 */
	public int getStudentIndex(Student si) {
		return preferenceList.indexOf(si);
	}
	
	/**
	 * Getting the number of projects offered by this Lecturer
	 * @return
	 */
	public int getTotalProjects() {
		return listOfProjects.size();
	}
	
	/**
	 * Getting a Student based on the provided index
	 * @param index
	 * @return The Student with the given index
	 */
	public Student getStudentByIndex(int index) {
		return preferenceList.get(index);
	}
	
	/**
	 * Getting a Project based on the provided index
	 * @param index
	 * @return The Project with the given index
	 */
	public Project getProjectByIndex(int index) {
		return listOfProjects.get(index);
	}
}
