#include <sourcemod>
#include <sdktools>

public void OnMapStart()
{
	char MapName[64];
	GetCurrentMap(MapName, sizeof(MapName));
	if (StrContains(MapName, "mvm_sequoia", false) == 0)
		PrecacheModel("models/props_foliage/tree_pine01.mdl");
}

