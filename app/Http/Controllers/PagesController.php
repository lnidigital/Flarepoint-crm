<?php
namespace App\Http\Controllers;

use DB;
use Carbon;
use App\Http\Requests;
use App\Repositories\Referral\ReferralRepositoryContract;
use App\Repositories\Onetoone\OnetoOneRepositoryContract;
use App\Repositories\Revenue\RevenueRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Group\GroupRepositoryContract;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;

class PagesController extends Controller
{

    protected $users;
    protected $cntacts;
    protected $settings;
    protected $referrals;
    protected $groups;

    public function __construct(
        UserRepositoryContract $users,
        SettingRepositoryContract $settings,
        ReferralRepositoryContract $referrals,
        OnetoOneRepositoryContract $onetoones,
        ContactRepositoryContract $contacts,
        RevenueRepositoryContract $revenues,
        GroupRepositoryContract $groups,
        Guard $guard
    ) {
        $this->users = $users;
        $this->settings = $settings;
        $this->referrals = $referrals;
        $this->onetoones = $onetoones;
        $this->revenues = $revenues;
        $this->contacts = $contacts;
        $this->groups = $groups;

    }

    /**
     * Dashobard view
     * @return mixed
     */
    public function dashboard()
    {
     
      $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }

      
      $members = $this->contacts->getAllMembers($groupId);

      $referralsThisMonth = $this->referrals->referralsMadeThisMonth();

      $onetoonesThisMonth = $this->onetoones->onetoonesMadeThisMonth();

      $guestsThisMonth = $this->contacts->guestsMadeThisMonth();

      $revenuesThisMonth = $this->revenues->revenuesMadeThisMonth();


      //Log::info("dashboard members: " . json_encode($members));
      
      /**
         * Other Statistics
         *
         */
        $companyname = $this->settings->getCompanyName();
        $users = $this->users->getAllUsers();
        
     /**
      * Statistics for all-time tasks.
      *
      */
        // $alltasks = $this->tasks->tasks();
        // $allCompletedTasks = $this->tasks->allCompletedTasks();
        // $totalPercentageTasks = $this->tasks->percantageCompleted();

     /**
      * Statistics for today tasks.
      *
      */
        // $completedTasksToday =  $this->tasks->completedTasksToday();
        // $createdTasksToday = $this->tasks->createdTasksToday();

     /**
      * Statistics for tasks this month.
      *
      */
         // $taskCompletedThisMonth = $this->tasks->completedTasksThisMonth();
    
    /**
      * Statistics for referrals this month.
      *
      */
         

     /**
      * Statistics for tasks each month(For Charts).
      *
      */
        // $createdTasksMonthly = $this->tasks->createdTasksMothly();
        // $completedTasksMonthly = $this->tasks->completedTasksMothly();

     $createdReferralsMonthly = $this->referrals->createdReferralsMothly();

     $createdRevenuesMonthly = $this->revenues->createdRevenuesMothly();

     $createdOnetoOnesMonthly = $this->onetoones->createdOnetoOnesMothly();

     /**
      * Statistics for all-time Leads.
      *
      */
     
        // $allleads = $this->leads->leads();
        // $allCompletedLeads = $this->leads->allCompletedLeads();
        // $totalPercentageLeads = $this->leads->percantageCompleted();
     /**
      * Statistics for today leads.
      *
      */
        // $completedLeadsToday = $this->leads->completedLeadsToday();
        // $createdLeadsToday = $this->leads->completedLeadsToday();

     /**
      * Statistics for leads this month.
      *
      */
        // $leadCompletedThisMonth = $this->leads->completedLeadsThisMonth();

     /**
      * Statistics for leads each month(For Charts).
      *
      */
        // $completedLeadsMonthly = $this->leads->createdLeadsMonthly();
        // $createdLeadsMonthly = $this->leads->completedLeadsMonthly();
       
        return view('pages.dashboard', compact(
            'onetoonesThisMonth',
            'referralsThisMonth',
            'guestsThisMonth',
            'revenuesThisMonth',
            'createdReferralsMonthly',
            'createdRevenuesMonthly',
            'createdOnetoOnesMonthly',
            'users',
            'members',
            'companyname'
        ));
    }

    public function store() {
      $groupId = Input::get('group_id');
      Log::info('store session='.$groupId);
      session(['user_group_id'=>$groupId]);
      return redirect()->route('dashboard');
    }
}
