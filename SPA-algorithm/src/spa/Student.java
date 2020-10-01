package spa;

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Student extends User {
	private List<Project> preferenceList;
	private List<Integer> projectIDs;
	private Project allocatedProject;
	private Lecturer supervisor;
	boolean projectIsAllocated = false;
	
	public Student(int id, Scanner s) {
		preferenceList = new ArrayList<Project>();
		projectIDs = new ArrayList<Integer>();
		setID(id);
		
		// Getting the student's details
		String username = s.next();
		this.setUsername(username);
		
		// Reading the student's preference list
		s.nextLine();
		String preferences = s.nextLine();
		String totalPreferences[] = preferences.split(" ");
		
		// Adding preferences to the preference list
		for(String project : totalPreferences) {
			projectIDs.add(Integer.valueOf(project));
		}
	}
	
	/*
	 * Add the Project pj into the Student's preference list
	 */
	public void addToPreferenceList(Project pj) {
		preferenceList.add(pj);
	}
	
	/*
	 * Making a provisional assignment between a student and a project
	 */
	public void assignProject(Project pj) {
		allocatedProject = pj;
		projectIsAllocated = true;
		pj.assignStudent(this);
	}
	
	/*
	 * Adding the Student to the list of those supervised by the relevant Lecturer
	 * after a provisional assignment
	 */
	public void assignLecturer(Lecturer lk) {
		supervisor = lk;
		lk.addSupervisee(this);
	}
	
	/*
	 * Check if a student is allocated to a Project or if they are available
	 */
	public boolean isFree() {
		return !projectIsAllocated && hasNonEmptyList();
	}
	
	/*
	 * Check if a free Student has Projects on their list
	 */
	public boolean hasNonEmptyList() {
		if(this.preferenceList.size() > 0 && supervisor == null && allocatedProject == null) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/*
	 * Getting the highest ranked Project on the Student's preference list
	 */
	public Project getFirstPreference() {
		Project pj = this.preferenceList.get(0);
		return pj;
	}
	
	/*
	 * Getting the total number of preferences for the Student
	 */
	public int totalPreferences() {
		return projectIDs.size();
	}
	
	/*
	 * Adding a Project to the Student's preference list
	 */
	public void addProjectToPreferenceList(Project pj) {
		this.preferenceList.add(pj);
	}
	
	/*
	 * Getting a Project with the given index
	 */
	public int getProjectIDByIndex(int index) {
		return projectIDs.get(index);
	}
	
	/*
	 * Check if the Student is interested in Project pj
	 */
	public boolean studentWantsProject(Project pj) {
		return preferenceList.contains(pj);
	}
	
	/*
	 * Getting the Project that this Student is allocated to
	 */
	public Project getAllocatedProject() {
		return this.allocatedProject;
	}
	
	/*
	 * Breaking the provisional assignment between a Student and a Project/Lecturer
	 */
	public void breakProvisionalAssignment() {
		supervisor.breakProvisionalAssignment(this);
		supervisor = null;
		allocatedProject.breakProvisionalAssignment(this);
		allocatedProject = null;
		projectIsAllocated = false;
	}
	
	/*
	 * If the Student cannot be assigned to Project pj, it is removed
	 */
	public void removeProjectFromPreferenceList(Project pj) {
		this.preferenceList.remove(pj);
	}
}
