#pragma semicolon 1

#define DEBUG

#define PLUGIN_AUTHOR "theAgamer11"
#define PLUGIN_VERSION "1.3"

#include <sourcemod>
#include <sdktools>
#include <sdkhooks>
#include <tf2>
#include <tf2_stocks>
#include <tf2attributes>

public Plugin myinfo = 
{
	name = "Bison Barrage Accompanying Plugin",
	author = PLUGIN_AUTHOR,
	description = "A plugin to be run when playing the MvM mission, Bison Barrage",
	version = PLUGIN_VERSION,
	url = ""
};

bool g_IsMyMission = false;
ArrayList usedNames;
public void OnPluginStart()
{
	usedNames = new ArrayList(32, 6);
	HookEvent("mvm_wave_failed", Event_WaveFailed, EventHookMode_Pre);
	HookEvent("player_spawn", Event_BotSpawn, EventHookMode_Post);
	HookEvent("player_death", Event_BotDeath, EventHookMode_Pre);
	HookEvent("teamplay_flag_event", Event_BombPickedUp, EventHookMode_Pre);
	InitGamedata();
	Event_WaveFailed(null, "", true);
}

bool previousMissionCheck = false;
Handle canteentimers[2];
Handle rainbowtimer;
Handle morphtimer;
void Event_WaveFailed(Event event, const char[] name, bool dontBroadcast)
{
	char missionName[4096];
	int objectiveEntity = FindEntityByClassname(-1, "tf_objective_resource");
	if (!IsValidEntity(objectiveEntity)) {
		return;
	}
	GetEntPropString(objectiveEntity, Prop_Send, "m_iszMvMPopfileName", missionName, sizeof(missionName));
	g_IsMyMission = StrContains(missionName, "mvm_waterfront_rc3_bison_barrage") != -1;
	if (g_IsMyMission && !previousMissionCheck) {
		HookAllPlayers();
	}
	previousMissionCheck = g_IsMyMission;
	if (canteentimers[0] != null) {
		KillTimer(canteentimers[0]);
		canteentimers[0] = null;
		KillTimer(canteentimers[1]);
		canteentimers[1] = null;
	}
	if (rainbowtimer != null) {
		KillTimer(rainbowtimer);
		rainbowtimer = null;
		KillTimer(morphtimer);
		morphtimer = null;
	}
}

void HookAllPlayers()
{
	if (!g_IsMyMission) {
		return;
	}
	for (new i = 1; i <= MaxClients; i++) {
		if (IsClientInGame(i) && !IsFakeClient(i)) {
       		SDKHook(i, SDKHook_OnTakeDamage, OnTakeDamage);
       		SetNewName(i);
		}
	}
}

public OnClientPutInServer(client)
{
	if (!g_IsMyMission) {
		return;
	}
	SetNewName(client);
	SDKHook(client, SDKHook_OnTakeDamage, OnTakeDamage);
}

char prefixes[][] = {"Blundering", "Hairy-backed", "Infantile", "Brainwashed", "Ninny-headed",
		"Neck-breathing", "Unhygenic", "Outlandish", "Diseased", "Witless", "Mud-for-brains", "Unremarkable",
		"Sexy", "Wart-covered", "Moldy", "Undesirable", "Beauty-lacking", "Constipated"};
char suffixes[][] = {"Oaf", "Wart", "Hag", "Neanderthal", "Rookie", "Blobfish", "Mosquito",
		"Slug", "Sloth", "Squirrel", "Maggot", "Elephant", "Hobo", "Hippie", "Eldritch Terror", "Sneeze" };
void SetNewName(int client)
{
	if (IsFakeClient(client)) { // Only change player names.
		return;
	}
	char clientsteamid[32];
	GetClientAuthId(client, AuthId_Steam3, clientsteamid, sizeof(clientsteamid));
	if (StrEqual(clientsteamid, "[U:1:149744445]")) {
		SetClientName(client, "Brilliant Mission Maker, Agamer");
	} else if (StrEqual(clientsteamid, "[U:1:14147524]")) {
		SetClientName(client, "I <3 scout_bat");
	} else if (StrEqual(clientsteamid, "[U:1:110929573]")) {
		SetClientName(client, "What are deadlines?");
	} else if (StrEqual(clientsteamid, "[U:1:106992137]")) {
		SetClientName(client, "Certified Good Meme");
	} else if (StrEqual(clientsteamid, "[U:1:40294185]")) {
		SetClientName(client, "Snitter");
	} else if (StrEqual(clientsteamid, "[U:1:169916051]")) {
		SetClientName(client, "Mr. In Absentia");
	} else if (StrEqual(clientsteamid, "[U:1:41114469]")) {
		SetClientName(client, "Friendly Fire Hazard");
	} else if (StrEqual(clientsteamid, "[U:1:172771484]")) {
		SetClientName(client, "Gambling Addiction");
	} else {
		char newName[MAX_NAME_LENGTH];
		do {
			int rand1 = GetRandomInt(0, sizeof(prefixes) - 1);
			int rand2 = GetRandomInt(0, sizeof(suffixes) - 1);
			Format(newName, sizeof(newName), "%s %s", prefixes[rand1], suffixes[rand2]);
		} while (usedNames.FindString(newName) != -1);
		usedNames.PushString(newName);
		if (StrEqual(clientsteamid, "[U:1:81048704]")) {
			StrCat(newName, sizeof(newName), " | MVM.TF");
		}
		SetClientName(client, newName);
	}
}

public void OnMapStart() {
	usedNames.Clear();
}

public void OnEntityCreated(entity, const char[] classname)
{
	if (!g_IsMyMission) {
		return;
	}
	if (!StrEqual(classname, "instanced_scripted_scene", false)) return;
	SDKHook(entity, SDKHook_Spawn, OnSceneSpawned);
}

public Action:OnSceneSpawned(int entity)
{
	if (GameRules_GetRoundState() == RoundState_RoundRunning) {
		return;
	}
	char scenefile[128];
	GetEntPropString(entity, Prop_Data, "m_iszSceneFile", scenefile, sizeof(scenefile));
	if (StrContains(scenefile, "true_scotsmans_call") != -1) { // Check for bad pipers.
		int client = GetEntPropEnt(entity, Prop_Data, "m_hOwner");
		float position[3];
		position[2] + 50;
		GetClientAbsOrigin(client, position);
		int tank = CreateEntityByName("tank_boss");
		if (IsValidEntity(tank)) {
			SetStartingPathTrackNode(tank, "tankpath_same");
			DispatchSpawn(tank);
			SetVariantInt(100000); 
			AcceptEntityInput(tank, "SetMaxHealth");
			SetVariantInt(100000); 
			AcceptEntityInput(tank, "SetHealth");
			TeleportEntity(tank, position, NULL_VECTOR, NULL_VECTOR); // Teleport tank onto bad pipers.
			CreateTimer(5.0, KillTank, tank);
		}
		PrintToChat(client, "\x087CFF26FFThat is a bad taunt and you should feel bad.");
	}
}

// Current effect of the Mighty Morphin' Ultra-Soldier. See "RainbowTimer()" for context
// 0: Nothing, 1: Fire, 2: Caustic, 3: Jarate, 4: Airblast, 5: Gas, 6: Uber, 7: Heal-on-Hit, 8: Crits
int currentColor = 0;
bool gasImmune[MAXPLAYERS + 1]; // Stops the same particle from both giving the cond and triggering the gas
public Action:OnTakeDamage(victim, &attacker, &inflictor, &Float:damage, &damagetype)
{
	if (!g_IsMyMission) {
		return Plugin_Continue;
	}
	int cond = GetEntData(victim, FindSendPropInfo("CTFPlayer","m_nPlayerCond"));
	if(cond & 32) { // Player is ubered.
		return Plugin_Continue;
	} 
	
	if (attacker == 0 || attacker > MaxClients) { // Invalid attacker.
		return Plugin_Continue;
	}
	
	if (!IsFakeClient(attacker)) { // Player attacker.
		return Plugin_Continue;
	}
	
	char attackername[32];
	GetClientInfo(attacker, "name", attackername, sizeof(attackername));
	if (StrEqual(attackername, "Gas Sprayin' Bison Soldier") || StrEqual(attackername, "Gas Sprayin' Mega-Soldier")
				|| (StrEqual(attackername, "Mighty Morphin' Ultra-Soldier") && currentColor == 5)) { // Regular gas
		if (!TF2_IsPlayerInCondition(victim, TFCond_Gas) && !TF2_IsPlayerInCondition(victim, TFCond_OnFire)) { // If not gassed/burning, gas player
			TF2_AddCondition(victim, TFCond_Gas, 6.0, 0);
			gasImmune[victim] = true;
			CreateTimer(0.25, EndGasImmuneTimer, victim);
			return Plugin_Handled;
		} else if (gasImmune[victim]) { // If gassed in last .25 seconds, do nothing
			return Plugin_Handled;
		} // Else, trigger gas like a normal bot would
	} else if (StrEqual(attackername, "Combustion Lovin' Bison Soldier")) { // EoI gas
		if (damage == 4.0 || damage == 350.0) { // Let through any fire and EoI damage
			return Plugin_Continue;
		} else if (gasImmune[victim]) { // If gassed in the last .25 seconds, do nothing
			return Plugin_Handled;
		} else if (!TF2_IsPlayerInCondition(victim, TFCond_Gas)) { // If not gassed, gas player
			TF2_AddCondition(victim, TFCond_Gas, 6.0, attacker);
			gasImmune[victim] = true;
			CreateTimer(0.25, EndGasImmuneTimer, victim);
			return Plugin_Handled;
		}
	} 
	if (TF2_IsPlayerInCondition(victim, TFCond_Gas) && !gasImmune[victim]) { // Mimics non-EoI gas because the cond doesn't actually ignite player.
		int wave = GetEntProp(FindEntityByClassname(-1, "tf_objective_resource"), Prop_Send, "m_nMannVsMachineWaveCount");
		if (wave != 4) {
			TF2_RemoveCondition(victim, TFCond_Gas);
			TF2_IgnitePlayer(victim, attacker);
			gasImmune[victim] = true;
			CreateTimer(0.25, EndGasImmuneTimer, victim);
		}
	}
	
	if (StrEqual(attackername, "Piss Slingin' Bison Soldier") || (StrEqual(attackername, "Mighty Morphin' Ultra-Soldier") && currentColor == 3)) {
		TF2_AddCondition(victim, TFCond_Jarated, 10.0, 0);
		damage /= 2.5;
		return Plugin_Changed;
	} else if (StrEqual(attackername, "Taunt Killin' Bison Soldier")) { // Forces player to do current taunt
		FakeClientCommand(victim, "taunt");
	} else if (StrEqual(attackername, "Melee Duelin' Mega-Soldier")) { // Temporarily forces use of melee
		SetEntPropEnt(victim, Prop_Send, "m_hActiveWeapon", GetPlayerWeaponSlot(victim, 2)); 
		TF2Attrib_SetByName(victim, "disable weapon switch", 1.0);
		CreateTimer(2.0, RemoveMeleeRestriction, victim);
	}
	return Plugin_Continue;
}

Handle ubertimers[MAXPLAYERS + 1];
void Event_BotSpawn(Event event, const char[] name, bool dontBroadcast)
{
	if (!g_IsMyMission || GameRules_GetRoundState() != RoundState_RoundRunning) {
		return;
	}
	char spawnedbot[32];
	int botclient = GetClientOfUserId(event.GetInt("userid"));
	GetClientInfo(botclient, "name", spawnedbot, sizeof(spawnedbot));
	if (!IsFakeClient(botclient)) { // Not a bot
		return;
	}
	if (StrEqual(spawnedbot, "Uber Flashin' Bison Soldier") || StrEqual(spawnedbot, "Uber Flashin' Mega-Soldier")) {
		ubertimers[botclient] = CreateTimer(4.0, FlashUber, botclient, TIMER_REPEAT);
	} else if (StrEqual(spawnedbot, "Canteen Crashin' Ultra-Soldier")) {
		CreateTimer(10.0, DelayTimer, botclient);
		canteentimers[1] = CreateTimer(20.0, UberCanteen, botclient, TIMER_REPEAT);
	} else if(StrEqual(spawnedbot, "Mighty Morphin' Ultra-Soldier")) {
		rainbowtimer = CreateTimer(5.0, RainbowTimer, botclient, TIMER_REPEAT);
		morphtimer = CreateTimer(3.0, MorphTimer, botclient, TIMER_REPEAT);
	}
}

void Event_BotDeath(Event event, const char[] name, bool dontBroadcast)
{
	if (!g_IsMyMission) {
		return;
	}
	int botclient = GetClientOfUserId(event.GetInt("userid"));
	if (!IsFakeClient(botclient)) { // Not a bot
		return;
	}
	if (ubertimers[botclient] != null) { // Kill uber timers on bot death
		KillTimer(ubertimers[botclient]);
		ubertimers[botclient] = null;
	}
	
	// Remove boss timers on death
	char killedbot[32];
	GetClientInfo(botclient, "name", killedbot, sizeof(killedbot));
	if (StrEqual(killedbot, "Canteen Crashin' Ultra-Soldier") && canteentimers[0] != null) {
		KillTimer(canteentimers[0]);
		canteentimers[0] = null;
		KillTimer(canteentimers[1]);
		canteentimers[1] = null;
	}
	if (StrEqual(killedbot, "Mighty Morphin' Ultra-Soldier") && rainbowtimer != null) {
		KillTimer(rainbowtimer);
		rainbowtimer = null;
		KillTimer(morphtimer);
		morphtimer = null;
	}
}

void Event_BombPickedUp(Event event, const char[] name, bool dontBroadcast)
{
	if (!g_IsMyMission) {
		return;
	}
	if (event.GetInt("eventtype") == 1) {
		int botclient = event.GetInt("player");
		if (ubertimers[botclient] != null) { // Disables uber flash on bomb carrier
			KillTimer(ubertimers[botclient]);
			ubertimers[botclient] = null;
		}
	}
}

public Action EndGasImmuneTimer(Handle timer, int client)
{
	gasImmune[client] = false;
}

public Action FlashUber(Handle timer, int client)
{
	TF2_AddCondition(client, TFCond_Ubercharged, 1.5, 0);
	return Plugin_Continue;
}

public Action RemoveMeleeRestriction(Handle timer, int client)
{
	TF2Attrib_RemoveByName(client, "disable weapon switch");
}

// Offsets uber and crit canteen usage by 10 seconds
public Action DelayTimer(Handle timer, int client)
{
	canteentimers[0] = CreateTimer(20.0, CritCanteen, client, TIMER_REPEAT);
	CritCanteen(null, client);
}

public Action CritCanteen(Handle timer, int client)
{
	Event e = CreateEvent("player_used_powerup_bottle");
	e.SetInt("player", client);
	e.SetInt("type", 1);
	e.SetFloat("time", 0.0);
	e.Fire();
	TF2_AddCondition(client, TFCond_Kritzkrieged, 5.0, 0);
}

public Action UberCanteen(Handle timer, int client)
{
	Event e = CreateEvent("player_used_powerup_bottle");
	e.SetInt("player", client);
	e.SetInt("type", 2);
	e.SetFloat("time", 0.0);
	e.Fire();
	TF2_AddCondition(client, TFCond_Ubercharged, 5.0, 0);
}

int rainbowbison = -1;
int lastThreeEffects[3];
public Action RainbowTimer(Handle timer, int client)
{
	if (rainbowbison == -1) {
		rainbowbison = GetEntPropEnt(client, Prop_Send, "m_hActiveWeapon");
	}
	switch(currentColor) { // Remove old attributes
		case 1:
		{
			TF2Attrib_RemoveByName(rainbowbison, "Set DamageType Ignite");
		}
		case 2:
		{
			TF2Attrib_RemoveByName(rainbowbison, "damage penalty");
			TF2Attrib_RemoveByName(rainbowbison, "bleeding duration");
		}
		case 3:
		{
			TF2Attrib_RemoveByName(rainbowbison, "mark for death");
		}
		case 4:
		{
			TF2Attrib_RemoveByName(rainbowbison, "apply z velocity on damage");
		}
		case 7:
		{
			TF2Attrib_RemoveByName(rainbowbison, "heal on hit for rapidfire");
		}
	}
	do {
		currentColor = GetRandomInt(0, 8);
	} while (lastThreeEffects[0] == currentColor || lastThreeEffects[1] == currentColor || lastThreeEffects[2] == currentColor);
	lastThreeEffects[0] = lastThreeEffects[1];
	lastThreeEffects[1] = lastThreeEffects[2];
	lastThreeEffects[2] = currentColor;
	switch(currentColor) { // Add new attributes
		case 1:
		{
			TF2Attrib_SetByName(rainbowbison, "Set DamageType Ignite", 1.0);
		}
		case 2:
		{
			TF2Attrib_SetByName(rainbowbison, "damage penalty", 0.5);
			TF2Attrib_SetByName(rainbowbison, "bleeding duration", 5.0);
		}
		case 4:
		{
			TF2Attrib_SetByName(rainbowbison, "apply z velocity on damage", 275.0);
		}
		case 6:
		{
			TF2_AddCondition(client, TFCond_Ubercharged, 4.0, 0);
		}
		case 7:
		{
			TF2Attrib_SetByName(rainbowbison, "heal on hit for rapidfire", 50.0);
		}
		case 8:
		{
			TF2_AddCondition(client, TFCond_Kritzkrieged, 4.0, 0);
		}
	}
}

float newHeadScale = 1.9;
float headScaleStep = 1.4;
float newTorsoScale = 2.0;
float torsoScaleStep = -0.5;
float newHandScale = 0.5;
float handScaleStep = 0.75;
public Action MorphTimer(Handle timer, int client) {
	newHeadScale += headScaleStep;
	if (newHeadScale >= 7.3) {
		headScaleStep = -1.4;
	} else if (newHeadScale <= 0.5) {
		headScaleStep = 1.4;
	}	
	TF2Attrib_SetByName(rainbowbison, "head scale", newHeadScale);
	newTorsoScale += torsoScaleStep;
	if (newTorsoScale >= 3.0) {
		torsoScaleStep = -0.5;
	} else if (newTorsoScale <= 0.0) {
		torsoScaleStep = 0.5;
	}	
	TF2Attrib_SetByName(rainbowbison, "torso scale", newTorsoScale);
	newHandScale += handScaleStep;
	if (newHandScale >= 3.5) {
		handScaleStep = -0.75;
	} else if (newHandScale <= 0.5) {
		handScaleStep = 0.75;
	}	
	TF2Attrib_SetByName(rainbowbison, "hand scale", newHandScale);
}

Handle CTFTankBoss_SetStartingPathTrackNode;

stock void InitGamedata()
{
	Handle conf = LoadGameConfigFile("bison_barrage");

	StartPrepSDKCall(SDKCall_Entity);
	PrepSDKCall_SetFromConf(conf, SDKConf_Signature, "CTFTankBoss::SetStartingPathTrackNode");			// void CTFTankBoss::SetStartingPathTrackNode( const char *pNodeName )
	PrepSDKCall_AddParameter(SDKType_String, SDKPass_Pointer);											// const char *pNodeName
	CTFTankBoss_SetStartingPathTrackNode = EndPrepSDKCall();
	if (CTFTankBoss_SetStartingPathTrackNode == null)
		SetFailState("Could not initialize call to CTFTankBoss::SetStartingPathTrackNode!");

	delete conf;
}

stock void SetStartingPathTrackNode(int iTank, const char[] TrackName)
{
	SDKCall(CTFTankBoss_SetStartingPathTrackNode, iTank, TrackName);
}

public Action KillTank(Handle timer, int tankEntity)
{
	AcceptEntityInput(tankEntity, "Kill", 0);
}